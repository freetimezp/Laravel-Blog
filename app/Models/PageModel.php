<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    public function make_links($url, $curpage, $button_num = 2) {
        $curpage = $curpage ? (int)$curpage : 1;

        $start = $curpage - $button_num;
        $end = $curpage + $button_num;
        if($start < 1) {
            $start = 1;
        }

        $buttons = [];
        $buttons[] = [
            'First',
            preg_replace('/page=[0-9]+/', 'page=1', $url),
            0
        ];

        for ($i = $start; $i <= $end; $i++) {
            $myurl = preg_replace('/page=[0-9]+/', 'page=' . $i, $url);
            $active = 0;
            if($i == $curpage) {
                $active = 1;
            }
            $buttons[] = [$i, $myurl, $active];
        }

        $buttons[] = [
            'Next',
            preg_replace('/page=[0-9]+/', 'page=' . ($curpage + 1), $url),
            0
        ];


        return $buttons;
    }
}
