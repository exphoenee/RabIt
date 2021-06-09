<?php
  class TableView {
    private $header;
    private $data;
    private $editable;
    private $select;
    private $idKey;

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

      foreach ($records as &$record) {
        $deleteUrl = Request::MakeURL($page, "delete", $record[$this->idKey]);
        $updateUrl = Request::MakeURL($page, "edit", $record[$this->idKey]);

        if ($this->editable) {
          if (Request::GetParam() != $record[$this->idKey]) {
            $record['Edit'] = View::createLinkButton($updateUrl, "Szerkesztés");
          } else {
            if (is_object($this->select)) {
              $this->select->setId($record[$this->idKey]);
            }
            $record['Edit'] = View::renderEditorMenu($record, false, $this->select);
          }
          $record['Delete'] = View::createLinkButton($deleteUrl, "Törlés", "delete");
        }
      }

      $this->data = $records;
    }

    public function render() {
      $html = '';
      $thead = '';
      $tbody = '';

      $thead .= '<tr>';
      foreach ($this->header as $columnName) {

        $thead .= '<th>'. $columnName .'</th>';
      }
      $thead .= '</tr>';

      $this->genereateCells();

      foreach ($this->data as $row) {
        $tbody .= '<tr id="">';


        foreach ($row as $cell) {
          $tbody .= '<td>'. $cell .'</td>';
        }

        $tbody .= '</tr">';
      }

      $html .=
        '<table><thead>'.$thead.'</thead><tbody>'.$tbody.'</tbody></table>';
      return $html;
    }
  }

?>