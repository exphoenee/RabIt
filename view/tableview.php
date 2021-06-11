<?php
/*
* This class renders the tables out it takes only a database table, end a boolean, according to that renders the class the editor menu as well
* TODO: It would be better declaring an interface, and injecting here any class against the select, that is implementing this interface. These classas can be any input fileds. Or an associative array of these object, and with th column name of the thabe with the informations accoring to render.
*/
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

    /*
    * with this method we can set the tabel editable after instantiation
    * Maybe here woudl be better creating a new object against injeting that.
    */
    public function setEditable($editable = true) {
      $this->editable = $editable;
      return $this;
    }

    /*
    * with this method we can pass a SelectView class to render out in the cells against an input filed
    */
    public function setSelector($select) {
      $this->select = $select;
      return $this;
    }

    /*
    * with this method generates the cells of the table
    */
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

    /*
    * with this method renders the HTML code of the entire table
    */
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