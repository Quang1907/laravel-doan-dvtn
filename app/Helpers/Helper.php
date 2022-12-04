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

if ( !function_exists( "check_time") ) {
    function check_time( $event  ) {
        $now = Carbon::now();
        if ( $now->between( $event->start,  $event->end ) ) {
            return '<span class="bg-primary text-white font-semibold py-1 px-3 rounded-full text-xs">Đang diễn ra</span>' ;
        }
        if ( $now->greaterThan( $event->end ) ) {
            return '<span class="bg-success text-white font-semibold py-1 px-3 rounded-full text-xs">Đã hoàn thành</span>' ;
        }
        return '<span class="bg-warning text-white font-semibold py-1 px-3 rounded-full text-xs">Chưa diễn ra</span>';

    }
}

if ( !function_exists( "check_time_end") ) {
    function check_time_end( $timeEnd  ) {
        $now = Carbon::now();
        return $now->greaterThan( $timeEnd  ) ? true : false;
    }
}

if ( !function_exists( "check_active_event") ) {
    function check_active_event( $active ) {
        if ( $active ) {
            echo '<span class="bg-success text-white font-semibold py-1 px-3 rounded-full text-xs">Đã tham gia</span>' ;
        }else{
            echo '<span class="bg-danger text-white font-semibold py-1 px-3 rounded-full text-xs">Không tham gia</span>' ;
        }
    }
}

if ( !function_exists( "format_array" ) ) {
    function format_array( $array = [] ) {
        if ( !empty( $array ) ) {

            $arr = [];
            foreach ( $array as $key => $value) {
                $arr[] = $key;

            }
            return $arr;
        }
        return null;
    }
}

if ( !function_exists( "check_brand" ) ) {
    function check_brand( $keycheck,  $array = [] ) {
        if ( !empty( $array  ) ) {
            if ( in_array( $keycheck, $array ) ) {
                return "checked";
            }
        }
        return null;
    }
}

if ( !function_exists( "score_rating" ) ) {
    function score_rating( $rank ) {
        if ( empty( $rank ) ) return "Chưa có dữ liệu";
        if ( $rank <= config( "admin.rank.medium" ) ) {
            return "Yếu";
        } elseif( $rank <= config( "admin.rank.good" ) ) {
            return "Trung bình";
        } elseif( $rank <= config( "admin.rank.veryGood" ) ) {
            return "Khá";
        } elseif( $rank < config( "admin.rank.excellent" ) ) {
            return "Giỏi";
        } elseif( $rank == config( "admin.rank.excellent" ) ) {
            return "Xuất sắc";
        }
    }
}
