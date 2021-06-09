<?php
class SelectView {
  private $values;
  private $column;
  private $primaryKey;
  private $err;
  private $selected;
  private $id;
  private $noLabel;

  public function __construct($values, $column, $primaryKey) {
    $this->values = $values;
    $this->noLabel = false;
    $this->column = $column;
    $this->primaryKey = $primaryKey;
    $this->err = isset($this->values[0][$this->primaryKey]);
    $this->id = "add";
  }

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function setSelected($selected) {
    $this->selected = $selected;
    return $this;
  }

  public function getForeignKey() {
    return $this->column;
  }

  public function setNoLabel($noLabel) {
    $this->noLabel = $noLabel;
    return $this;
  }

  public function render() {
      $html = '';

      if ($this->err) {
        $html .=
        '<div class="inputfiled">';
        var_dump(!$this->noLabel);
        if (!$this->noLabel) {
          $html .=
            '<label
              for="'. $this->column."-".$this->id.'">'
                . Mocks::$filedNames[$this->column].
            ' </label>';
        }
        $html .=
          '<select
            id="'. $this->column."-".$this->id.'"
            name="'. $this->primaryKey .'">';
        foreach ($this->values as $id => $record) {
          $html .=
            '<option
              value="'.$record[$this->primaryKey].'" '
                .($this->selected == $record[$this->primaryKey] ? 'selected' : '').
              '>'
                .$record[$this->column].
              '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
      }
      return $html;
    }
  }
?>