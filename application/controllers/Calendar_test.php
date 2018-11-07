<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_test extends CI_Controller
{
    public $user_id = 1;

    /**
     * Index Page for this controller.
     */
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('default_layout');
        //$this->load->model('Outsite_model', 'outsite');


    }
    public  function  index($m=null){
        if($m==null){$m = date('n');
         }
        $prefs = array(
            'start_day'    => 'sunday',
            'month_type'   => 'long',
            'translated_day_names' => true,
            'day_type'     => 'short',
            'show_next_prev'  => false,
            'next_prev_url'   => site_url().'calendar_test/'.$m
        );

        $prefs['template'] = '

        {table_open}<table class="table table-bordered">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
';
        $prefs['translated_day_names'] = array('จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์', 'อาทิตย์');
        $prefs['translated_month_names'] = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => '...', '04' => '...', '05' => '...', '06' => '...', '07' => '.', '08' => 'สิงหาคม', '09' => 'yyy', '10' => 'yy', '11' => 'november in your language', '12' => 'december');

        $this->load->library('calendar',$prefs);
        $y=date('Y');
        $d = array(
            3  => base_url().'',
            7  => 'http://example.com/news/article/2006/06/07/',
            13 => 'http://example.com/news/article/2006/06/13/',
            26 => 'http://example.com/news/article/2006/06/26/'
        );

        $data['calendar']= $this->calendar->generate($y,$m,$d);

        //$data['calendar']='';
        $this->layout->view('calendar/index',$data);
    }
}