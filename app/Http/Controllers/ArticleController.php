<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;

require_once "simple_html_dom.php";

class ArticleController extends Controller
{
    var $querys = array(
            "http://js.vnu.edu.vn/index.php/EES/issue/archive",
            "http://js.vnu.edu.vn/index.php/ER/issue/archive",
            "http://js.vnu.edu.vn/index.php/EAB/issue/archive",
            "http://js.vnu.edu.vn/index.php/FS/issue/archive",
            "http://js.vnu.edu.vn/index.php/MaP/issue/archive",
            "http://js.vnu.edu.vn/index.php/LS/issue/archive",
            "http://js.vnu.edu.vn/index.php/NST/issue/archive",
            "http://js.vnu.edu.vn/index.php/PaM/issue/archive",
            "http://js.vnu.edu.vn/index.php/SSH/issue/archive"
        );

    public function data(){
        $allLink = array();
        foreach ($this->querys as $query) {
            $rs = file_get_html($query);
            $all_a_tag = $rs->find('body div div div div div div div h4 a');
            foreach ($all_a_tag as $link) {
                array_push($allLink, $link->href);
            }
        }
        return view('archive_vol')->with('archive_vol', $allLink);
    }

    public function info(Request $request){
        $allArticle = array();
        $rs = file_get_html($request->all()['link']);
        $articles = $rs->find('table tbody tr td div a text');
        foreach ($articles as $link) {
            if($link->outertext != "PDF"){
                array_push($allArticle, $link->outertext);   
            }
        }
        return view('articles_vol')->with('articles_vol', $allArticle);
    }

    public function detail(Request $request){
        $nameArticle = $request->all()['article'];
        $query = "https://scholar.google.com.vn/scholar?q=".urlencode($nameArticle)."&btnG=&hl=vi&as_sdt=0%2C5";
        $rs = file_get_html($query);
        $div = $rs->find('div[class="gs_fl"]')[1];
        $aTag = $div->find('a');
        
        $cluster_id = $aTag[0]->href;
        $cluster_id = str_replace("/scholar?cites=","",$cluster_id);
        $cluster_id = str_replace("&amp;as_sdt=2005&amp;sciodt=0,5&amp;hl=vi&amp;oe=ASCII","",$cluster_id);
        
        $relate_id = $aTag[1]->href;
        $relate_id = str_replace("/scholar?q=related:", "", $relate_id);
        $relate_id = str_replace(":scholar.google.com/&amp;hl=vi&amp;oe=ASCII&amp;as_sdt=0,5", "", $relate_id);


        $query = "https://scholar.google.com.vn/scholar?q=info:".$relate_id.":scholar.google.com/&output=cite&scirp=0&hl=vi";
        $rs = file_get_html($query);
        $mla = $rs->find('div[id="gs_cit0"]')[0];
        $apa = $rs->find('div[id="gs_cit1"]')[0];
        $iso = $rs->find('div[id="gs_cit2"]')[0];
        
        $article = new Article();
        $article->name = $nameArticle;
        $article->cluster_id = $cluster_id;
        $article->mla = $mla->plaintext;
        $article->apa = $apa->plaintext;
        $article->iso = $iso->plaintext;
        $article->save();

        return view('result')->with('article', $article);
    }

}
