<?php
  class TableView {
    private $header;
    private $data;
    private $editable;
    private $select;
    private $idKey;
    private $colNr;

    public function __construct($records, $editable = false) {
      $this->records = $records;
      $this->idKey = Controller::getPrimaryKey();;
      $this->editable = $this->idKey ? $editable : false;
      $this->select = false;
      $this->data = [];
      $this->header = [];


      $headerText = Mocks::headerText();
      $editor = Mocks::$editor;

      foreach (array_keys($this->records[0]) as $key) {
        $this->header[$key] = $headerText[$key];
      }

      if ($this->editable) {
        $this->header = array_merge($this->header, $editor);
      }
      $this->colNr = count($this->header);
    }

    public function setEditable($editable = true) {
      $this->editable = $editable;
      return $this;
    }

    public function setSelector($select) {
      $this->select = $select;
      return $this;
    }

    private function genereateCells() {
      $records = $this->records;
      $page = Request::GetPage();

      foreach ($records as $key => &$record) {
        $deleteUrl = Request::MakeURL($page, "delete", $record[$this->idKey]);
        $updateUrl = Request::MakeURL($page, "editor", $record[$this->idKey]);

        if ($this->editable) {
          if (Request::GetParam() != $record[$this->idKey]) {
            $record['editor-cell'] = View::createLinkButton($updateUrl, "Szerkesztés");
          } else {

            $from = $record;

            foreach ($record as $col => &$cell) {
              if ((!($col == $this->idKey))) {
                unset($record[$col]);
              }
            }

            if (is_object($this->select)) {
              $this->select->setNoLabel(true)->setId($record[$this->idKey]);
            }

            $record['editor-cell'] = View::renderEditorMenu($from, false, $this->select);
          }
          $record['delete-cell'] = View::createLinkButton($deleteUrl, "Törlés", "delete");
        }
      }

      $this->data = $records;
    }

    public function render() {
      $html = '';
      $thead = '';
      $tbody = '';

      $thead .= '<tr id="row-header">';
      foreach ($this->header as $key=>$columnName) {
        $thead .=
        '<th
          class="column '. $key .'"
        >'
          . $columnName .
        '</th>';
      }
      $thead .= '</tr>';

      $this->genereateCells();

      foreach ($this->data as $row) {
        $id = $row[$this->idKey];
        $tbody .= '<tr id="row-'. $id .'">';

        $thisColErr = ($this->colNr)-(count($row));
        foreach ($row as $key => $cell) {
          $tbody .=
          '<td
            id="cell-'. $key .'-'. $id .'"
            class="column '. $key .'"';

          if (($thisColErr > 0) && ($key === "editor-cell")) {
            $tbody .=
            'colspan="'.($thisColErr+1).'"';
          }

          $tbody .=
          '>'
            . $cell .
          '</td>';
        }

        $tbody .= '</tr">';
      }

      $html .=
        '<table><thead>'.$thead.'</thead><tbody>'.$tbody.'</tbody></table>';
      return $html;
    }
  }

?>