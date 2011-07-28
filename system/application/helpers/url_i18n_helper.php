<?php
/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access    public
 * @param    string
 * @return    string
 */    
function site_url_i18n($uri = '', $lang_code = '')
{
    $CI =& get_instance();
    if ($lang_code)
    {
        return $CI->config->site_url($lang_code.'/'.$uri);
    }
    else
    {
        return $CI->config->site_url($uri);
    }
}

    
// ------------------------------------------------------------------------

/**
 * Anchor Link
 *
 * Creates an anchor based on the local URL.
 *
 * @access    public
 * @param    string    the URL
 * @param    string    the link title
 * @param    mixed    any attributes
 * @return    string
 */    
    function anchor_i18n($uri = '', $title = '', $attributes = '')
    {
        $title = (string) $title;
    
        if ( ! is_array($uri))
        {
            $site_url = ( ! preg_match('!^\w+://!i', $uri)) ? site_url_i18n($uri, $lang_code) : $uri;
        }
        else
        {
            $site_url = site_url_i18n($uri, $lang_code);
        }
    
        if ($title == '')
        {
            $title = $site_url;
        }

        if ($attributes == '')
        {
            $attributes = ' title="'.$title.'"';
        }
        else
        {
            $attributes = _parse_attributes_i18n($attributes);
        }

        return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
    }
    
    function anchor_popup_i18n($uri = '', $title = '', $attributes = FALSE)
    {    
        $title = (string) $title;
    
        $site_url = ( ! preg_match('!^\w+://!i', $uri)) ? site_url_i18n($uri, $lang_code) : $uri;
    
        if ($title == '')
        {
            $title = $site_url;
        }
    
        if ($attributes === FALSE)
        {
            return "";
        }
    
        if ( ! is_array($attributes))
        {
            $attributes = array();
        }
        
        foreach (array('width' => '800', 'height' => '600', 'scrollbars' => 'yes', 'status' => 'yes', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0', ) as $key => $val)
        {
            $atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
        }

        return "";
    }
    
    
// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 *
 * @access    public
 * @param    string    the URL
 * @param    string    the method: location or redirect
 * @return    string
 */
function redirect_i18n($uri = '', $method = 'location', $lang_code = '')
{
    switch($method)
    {
        case 'refresh' : header("Refresh:0;url=".site_url_i18n($uri, $lang_code));
            break;
        default        : header("location:".site_url_i18n($uri, $lang_code));
            break;
    }
    exit;
}

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access    private
 * @param    array
 * @param    bool
 * @return    string
 */
function _parse_attributes_i18n($attributes, $javascript = FALSE)
{
    if (is_string($attributes))
    {
        return ($attributes != '') ? ' '.$attributes : '';
    }

    $att = '';
    foreach ($attributes as $key => $val)
    {
        if ($javascript == TRUE)
        {
            $att .= $key . '=' . $val . ',';
        }
        else
        {
            $att .= ' ' . $key . '="' . $val . '"';
        }
    }
    
    if ($javascript == TRUE AND $att != '')
    {
        $att = substr($att, 0, -1);
    }
    
    return $att;
} 
