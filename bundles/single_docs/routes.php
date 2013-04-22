<?php

/**
 * Load the Markdown library.
 */
require_once __DIR__.'/libraries/markdown.php';

/**
 * Get the root path for the documentation Markdown.
 *
 * @return string
 */
function doc_root()
{
	return path('sys').'documentation/';
}

/**
 * Get the parsed Markdown contents of a given page.
 *
 * @param  string  $page
 * @return string
 */
function document($page)
{
	return Markdown(raw_document($page));
}

function raw_document($page){
    return file_get_contents(doc_root().$page.'.md');
}

/**
 * Determine if a documentation page exists.
 *
 * @param  string  $page
 * @return bool
 */
function document_exists($page)
{
	return file_exists(doc_root().$page.'.md');
}


/**
 * Handle the documentation homepage.
 *
 * This page contains the "introduction" to Laravel.
 */
Route::get('(:bundle)', function()
{
    $handles = Bundle::option(Router::$bundle, 'handles','docs');
    $toc = raw_document('contents');
    if($handles != 'docs'){
        $toc = str_replace('/docs/', "/$handles/", $toc);
    }
    preg_match_all('#\(/' . preg_quote($handles) . '/([\w/\-]+)(\#([\w\-]+))?\)#', $toc, $matches, PREG_SET_ORDER);
    
    $markdowns = array();
    foreach($matches as $match){
        $file = $match[1];
        $hash = $key = str_replace('/', '_', $file);
        if(!isset($markdowns[$key])){
            if(!document_exists($file) && document_exists($file.'/home')) {
		$markdowns[$key] = raw_document($file . '/home');
            }
            else {
                $markdowns[$key] = raw_document($file);
            }
        }
        
        if(isset($match[3])){
            $hash = "{$key}_{$match[3]}";
            $markdowns[$key] = str_replace('<a name="' . $match[3] . '">', '<a name="' . $hash . '">', $markdowns[$key]);
        }
        else {
            
        }
        
        $toc = str_replace($match[0], "(/$handles/#$hash)" , $toc);
    }
    
    $sidebar = Markdown($toc);
    $content = "";
    foreach($markdowns as $key=>$md){
        $content .= '<a name="' . $key . '"></a><div>' . Markdown($md) . '</div>';
    }
    
    return View::make('single_docs::page')->with('sidebar',$sidebar)->with('content', $content);
});