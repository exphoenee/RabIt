<?php
class SelectView {
  private $values;
  private $column;
  private $primaryKey;
  private $err;
  private $selected;

  public function __construct($values, $column, $primaryKey) {
    $this->values = $values;
    $this->column = $column;
    $this->primaryKey = $primaryKey;
    $this->err = isset($this->values[0][$this->primaryKey]);
  }

  public function setSelected($selected) {
    $this->selected = $selected;
    return $this;
  }

    public function getForeignKey() {
    return $this->column;
  }

  public function render() {
      $html = '';

      if ($this->err) {
        $html .= '<select name="'. $this->column .'">';
        foreach ($this->values as $id => $record) {
          $html .=
            '<option
              name="'. $this->primaryKey .'"
              value="'.$record[$this->primaryKey].'" '
                .($this->selected == $record[$this->primaryKey] ? 'selected' : '').
              '>'
                .$record[$this->column].
              '</option>';
        }
        $html .= '</select>';
      }
      return $html;
    }
  }
?>