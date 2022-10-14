<?php

use Illuminate\Support\Carbon;

if ( !function_exists( "categorySelect" ) ) {
    function categorySelect( $categories, &$htmlOption, $select = "", $parent_id = null, $char = "" ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->parent_id == $parent_id ) {
                if ( old("parent_id", $select) == $category->id ) {
                    $htmlOption .= "<option value='$category->id' selected > $char $category->name </option>";
                }else {
                    $htmlOption .= "<option value='$category->id'> $char $category->name </option>";
                }
                unset( $categories[ $key ] );
                categorySelect($categories, $htmlOption, $select, $category->id, $char . "--" );
            }
        }
    }
}


if ( !function_exists( "format_date") ) {
    function format_date( $date ) {
        Carbon::setLocale('vi');
        $date = Carbon::create( $date );
        $now = Carbon::now();
        return $date->diffForHumans( $now );
    }
}


if ( !function_exists( "url_image") ) {
    function url_image( $url ) {
        if ( stripos( $url,  "drive.google.com" ) ) {
           return $url;
        }
        return  asset( "storage/" . $url) ;
    }
}
