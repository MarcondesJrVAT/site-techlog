<?php
/**
 * Form Helper
 *
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 * @date updated March 16, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Babita\Helpers;

/**
 * Create form elements quickly.
 */
class Form
{
    /**
     * open form
     *
     * This method return the form element <form...
     *
     * @param  [id, name, class, onsubmit, method, action, files, style]
     *
     * @return  string
     */
    public static function open($params = [])
    {
        $o = '<form';

        $o .= (isset($params['id']))
        ? " id='{$params['id']}'" : '';

        $o .= (isset($params['name']))
        ? " name='{$params['name']}'" : '';

        $o .= (isset($params['class']))
        ? " class='{$params['class']}'" : '';

        $o .= (isset($params['onsubmit']))
        ? " onsubmit='{$params['onsubmit']}'" : '';

        $o .= (isset($params['method']))
        ? " method='{$params['method']}'" : ' method="get"';

        $o .= (isset($params['action']))
        ? " action='{$params['action']}'" : '';

        $o .= (isset($params['files']))
        ? " enctype='multipart/form-data'" : '';

        $o .= (isset($params['style']))
        ? " style='{$params['style']}'" : '';

        $o .= (isset($params['role']))
        ? " role='{$params['role']}'" : '';

        $o .= (isset($params['autocomplete']))
        ? " autocomplete='{$params['autocomplete']}'" : '';

        $o .= '>';
        return $o."\n";
    }

    /**
     * closed the form
     *
     * @return string
     */
    public static function close()
    {
        return "</form>\n";
    }

    /**
     * textBox
     *
     * This method creates a textarea element
     *
     * @param   [id, name, class, onclick, columns, rows, disabled, placeholder, style, value]
     *
     * @return  string
     */
    public static function textBox($params = [])
    {
        $o = '<textarea';
        $o .= (isset($params['id']))
        ? " id='{$params['id']}'" : '';

        $o .= (isset($params['name']))
        ? " name='{$params['name']}'" : '';

        $o .= (isset($params['class']))
        ? " class='form-input textbox {$params['class']}'" : '';

        $o .= (isset($params['onclick']))
        ? " onclick='{$params['onclick']}'" : '';

        $o .= (isset($params['cols']))
        ? " cols='{$params['cols']}'" : '';

        $o .= (isset($params['rows']))
        ? " rows='{$params['rows']}'" : '';

        $o .= (isset($params['disabled']))
        ? " disabled='{$params['disabled']}'" : '';

        $o .= (isset($params['placeholder']))
        ? " placeholder='{$params['placeholder']}'" : '';

        $o .= (isset($params['maxlength']))
        ? " maxlength='{$params['maxlength']}'" : '';

        $o .= (isset($params['style']))
        ? " style='{$params['style']}'" : '';

        $o .= (isset($params['required']))
        ? " required='required'" : '';

        $o .= '>';

        $o .= (isset($params['value']))
        ? $params['value'] : '';

        $o .= "</textarea>\n";
        return $o;
    }

    /**
     * input
     *
     * This method returns a input text element.
     *
     * @param   [id, name, class, onclick, value, length, width, disable,placeholder]
     *
     * @return  string
     */
    public static function input($params = [])
    {
        $o = '<input ';

        $o .= (isset($params['type']))
        ? " type='{$params['type']}'" : 'type="text"';

        $o .= (isset($params['id']))
        ? " id='{$params['id']}'" : '';

        $o .= (isset($params['name']))
        ? " name='{$params['name']}'" : '';

        $o .= (isset($params['class']))
        ? " class='form-input text {$params['class']}'" : '';

        $o .= (isset($params['onclick']))
        ? " onclick='{$params['onclick']}'" : '';

        $o .= (isset($params['onkeypress']))
        ? " onkeypress='{$params['onkeypress']}'" : '';

        $o .= (isset($params['value']))
        ? ' value="' . $params['value'] . '"' : '';

        $o .= (isset($params['length']))
        ? " maxlength='{$params['length']}'" : '';

        $o .= (isset($params['width']))
        ? " style='width:{$params['width']}px;'" : '';

        $o .= (isset($params['disabled']))
        ? " disabled='{$params['disabled']}'" : '';

        $o .= (isset($params['placeholder']))
        ? " placeholder='{$params['placeholder']}'" : '';

        $o .= (isset($params['accept']))
        ? " accept='{$params['accept']}'" : '';

        $o .= (isset($params['maxlength']))
        ? " maxlength='{$params['maxlength']}'" : '';

        $o .= (isset($params['minlength']))
        ? " minlength='{$params['minlength']}'" : '';

        $o .= (isset($params['style']))
        ? " style='{$params['style']}'" : '';

        $o .= (isset($params['required']))
        ? " required='required'" : '';

        $o .= (isset($params['autocomplete']))
        ? " autocomplete='{$params['autocomplete']}'" : '';

        $o .= (isset($params['autofocus']))
        ? " autofocus" : '';

        $o .= " />\n";
        return $o;
    }

    /**
     * select
     *
     * This method returns a select html element.
     * It can be given a param called value which then will be preselected
     * data has to be [k=>v]
     *
     * @param   [id, name, class, onclick, disabled]
     *
     * @return  string
     */
    public static function select($params = [])
    {
        $o = "<select";
        $o .= (isset($params['id']))
        ? " id='{$params['id']}'" : '';

        $o .= (isset($params['name']))
        ? " name='{$params['name']}'" : '';

        $o .= (isset($params['class']))
        ? " class='{$params['class']}'" : '';

        $o .= (isset($params['onclick']))
        ? " onclick='{$params['onclick']}'" : '';

        $o .= (isset($params['width']))
        ? " style='width:{$params['width']}px;'" : '';

        $o .= (isset($params['required']))
        ? " required='required'" : '';

        $o .= (isset($params['disabled']))
        ? " disabled='{$params['disabled']}'" : '';

        $o .= (isset($params['style']))
        ? " style='{$params['style']}'" : '';

        $o .= ">\n";
        $o .= "<option value=''>Select</option>\n";
        if (isset($params['data']) && is_array($params['data'])) {
            foreach ($params['data'] as $k => $v) {
                if (isset($params['value']) && $params['value'] == $k) {
                    $o .= "<option value='{$k}' selected='selected'>{$v}</option>\n";
                } else {
                    $o .= "<option value='{$k}'>{$v}</option>\n";
                }
            }
        }
        $o .= "</select>\n";
        return $o;
    }

    /**
     * checkboxMulti
     *
     * This method returns multiple checkbox elements in order given in an array
     * For checking of checkbox pass checked
     * Each checkbox should look like [0=>['id'=>'1', 'name'=>'cb[]', 'value'=>'x', 'label'=>'label_text' ]
     *
     * @param   [[id, name, value, class, checked, disabled]]
     *
     * @return  string
     */
    public static function checkbox($params = [])
    {
        $o = '';
        if (!empty($params)) {
            $x = 0;
            foreach ($params as $k => $v) {
                $v['id'] = (isset($v['id']))
                ? $v['id'] : "cb_id_{$x}_".rand(1000, 9999);

                $o .= "<input type='checkbox'";

                $o .= (isset($v['id']))
                ? " id='{$v['id']}'" : '';

                $o .= (isset($v['name']))
                ? " name='{$v['name']}'" : '';

                $o .= (isset($v['value']))
                ? " value='{$v['value']}'" : '';

                $o .= (isset($v['class']))
                ? " class='{$v['class']}'" : '';

                $o .= (isset($v['checked']))
                ? " checked='checked'" : '';

                $o .= (isset($v['disabled']))
                ? " disabled='{$v['disabled']}'" : '';

                $o .= (isset($params['style']))
                ? " style='{$params['style']}'" : '';

                $o .= " />\n";

                $o .= (isset($v['label']))
                ? "<label for='{$v['id']}'>{$v['label']}</label> "  : '';

                $x++;
            }
        }
        return $o;
    }

    /**
     * radioMulti
     *
     * This method returns radio elements in order given in an array
     * For selection pass checked
     * Each radio should look like [0=>['id'=>'1', 'name'=>'rd[]', 'value'=>'x', 'label'=>'label_text' ]
     *
     * @param   [[id, name, value, class, checked, disabled, label]]
     *
     * @return  string
     */
    public static function radio($params = [])
    {
        $o = '';
        if (!empty($params)) {
            $x = 0;
            foreach ($params as $k => $v) {
                $v['id'] = (isset($v['id'])) ? $v['id'] : "rd_id_{$x}_".rand(1000, 9999);

                $o .= "<input type='radio'";

                $o .= (isset($v['id'])) ? " id='{$v['id']}'" : '';

                $o .= (isset($v['name']))
                ? " name='{$v['name']}'" : '';

                $o .= (isset($v['value']))
                ? " value='{$v['value']}'" : '';

                $o .= (isset($v['class']))
                ? " class='{$v['class']}'" : '';

                $o .= (isset($v['checked']))
                ? " checked='checked'" : '';

                $o .= (isset($v['disabled']))
                ? " disabled='{$v['disabled']}'" : '';

                $o .= (isset($params['style']))
                ? " style='{$params['style']}'" : '';

                $o .= " />\n";

                $o .= (isset($v['label']))
                ? "<label for='{$v['id']}'>{$v['label']}</label> " : '';

                $x++;
            }
        }
        return $o;
    }

    /**
     * This method returns a button element given the params for settings
     *
     * @param   [id, name, class, onclick, value, disabled]
     *
     * @return  string
     */
    public static function button($params = [])
    {
        $o = "<button type='submit'";

        $o .= (isset($params['id']))
        ? " id='{$params['id']}'" : '';

        $o .= (isset($params['name']))
        ? " name='{$params['name']}'" : '';

        $o .= (isset($params['class']))
        ? " class='{$params['class']}'" : '';

        $o .= (isset($params['onclick']))
        ? " onclick='{$params['onclick']}'" : '';

        $o .= (isset($params['disabled']))
        ? " disabled='{$params['disabled']}'" : '';

        $o .= (isset($params['style']))
        ? " style='{$params['style']}'" : '';

        $o .= ">";

        $o .= (isset($params['iclass']))
        ? "<i class='fa {$params['iclass']}'></i> " : '';

        $o .= (isset($params['value']))
        ? "{$params['value']}" : '';

        $o .= "</button>\n";
        return $o;
    }

    /**
     * This method returns a submit button element given the params for settings
     *
     * @param   [id, name, class, onclick, value, disabled]
     *
     * @return  string
     */
    public static function submit($params = [])
    {
        $o = '<input type="submit"';

        $o .= (isset($params['id']))
        ? " id='{$params['id']}'" : '';

        $o .= (isset($params['name']))
        ? " name='{$params['name']}'" : '';

        $o .= (isset($params['class']))
        ? " class='{$params['class']}'" : '';

        $o .= (isset($params['onclick']))
        ? " onclick='{$params['onclick']}'" : '';

        $o .= (isset($params['value']))
        ? " value='{$params['value']}'" : '';

        $o .= (isset($params['disabled']))
        ? " disabled='{$params['disabled']}'" : '';

        $o .= (isset($params['style']))
        ? " style='{$params['style']}'" : '';

        $o .= " />\n";
        return $o;
    }

    /**
     * This method returns a hidden input elements given its params
     *
     * @param   [id, name, class, value]
     *
     * @return  string
     */
    public static function hidden($params = [])
    {
        $o = '<input type="hidden"';

        $o .= (isset($params['id']))
        ? " id='{$params['id']}'" : '';

        $o .= (isset($params['name']))
        ? " name='{$params['name']}'" : '';

        $o .= (isset($params['class']))
        ? " class='{$params['class']}'" : '';

        $o .= (isset($params['value']))
        ? " value='{$params['value']}'" : '';

        $o .= " />\n";
        return $o;
    }
}
