<?php
    class DatePickerHelper extends AppHelper{
    //�w���p�[
    var $helpers = array("Form","Html");

    function datepicker($fieldName, $options = array()){
        //�O���t�@�C��
        $ext = $this->Html->script('jquery-1.10.2', array('inline' => false))
            . $this->Html->script('jquery-ui-1.10.4.custom', array('inline' => false))
            . $this->Html->script('jquery.ui.datepicker-ja', array('inline' => false))
            . $this->Html->css('jquery-ui-1.10.4.custom', null, array('inline' => false));

        //�e�L�X�g�{�b�N�X��html
        $ext .= $this->Form->input($fieldName, $options);

        //�e�L�X�g�{�b�N�X��ID
        if(isset($options["id"])) {
            $id = $options["id"];
        } else {
            $id = $this->Form->domId(array(), "for");
        }
        //�X�N���v�g����
        $script =
            "jQuery(function($){".
            "$(\"#".$id["for"]."\").datepicker({changeMonth: true,changeYear: true});".
            "});";

        return $ext . $this->Html->scriptBlock($script, array('inline' => false)); }
    }
?>