<?php
  class TableView {
    private $header;
    private $data;
    private $editable;

    public function __construct($records, $editable = false) {
      $idKey = null;

      $headerText = Mocks::headerText();
      $editor = ["edit" => "Szerkesztés", "delete" => "Törlés"];

      $this->header = [];
      foreach (array_keys($records[0]) as $key) {
        $this->header[$key] = $headerText[$key];
      }

      $idKey = Controller::getPrimaryKey();

      if (!$idKey) {
        $editable = false;
      }

      if ($editable) {
        $this->header = array_merge($this->header, $editor);
      }

      foreach ($records as &$record) {
        if ($editable) {
          if (Request::GetParam() != $record[$idKey]) {
            $record['Edit'] = '<div class="link-btn"><a href="'. Request::MakeURL(Request::GetPage(), "edit", $record[$idKey]) .'">Szerkesztés</a></div>';
          } else {
            $record['Edit'] = View::renderEditorMenu($record);
          }

          $record['Delete'] = '<div class="link-btn"><a href="'. Request::MakeURL(Request::GetPage(), "delete", $record[$idKey]) .'">Törlés</a></div>';
        }
      }

      $this->data = $records;
    }

    public function setEditable($editable = true) {
      $this->editable = $editable;
      return $this;
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