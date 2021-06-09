<?php
/*
* this class is responsible for the HTML select generation, and modification
*/
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

  /*
  * this method can pass an id after the instantiation
  */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /*
  * this method can set the value of the select (HTML attr. selected) after the instantiation
  */
  public function setSelected($selected) {
    $this->selected = $selected;
    return $this;
  }

  /*
  * this method can set the foreign key what for is made the select HTML element
  */
  public function getForeignKey() {
    return $this->column;
  }

  /*
  * this method can turn off the label of the select HTML element
  */
  public function setNoLabel($noLabel) {
    $this->noLabel = $noLabel;
    return $this;
  }

  /*
  * generating the HTML code
  */
  public function render() {
      $html = '';

      if ($this->err) {
        $html .=
        '<div class="inputfiled">';
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