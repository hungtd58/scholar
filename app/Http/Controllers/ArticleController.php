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
        $allLink = array();
        $cluster_id = "";
        $relate_id = "";

        $nameArticle = $request->all()['article'];
        
        $articleNeedInfo = Article::where("name", $nameArticle)->first();

        if($articleNeedInfo == null){
            $query = "https://scholar.google.com.vn/scholar?q=".urlencode($nameArticle)."&btnG=&hl=vi&as_sdt=0%2C5";

            $rs = file_get_html($query);
            $div = $rs->find('div[class="gs_r"]')[0];
            $div1 = $div->find('div[class="gs_ri"]')[0];
            $div2 = $div1->find('div[class="gs_fl"]')[0];
            $aTags = $div2->find('a');
            foreach ($aTags as $aTag) {
                array_push($allLink, $aTag->href);
                if(strpos($aTag->href, "/scholar?q=related") !== false){
                    $relate_id = $aTag->href;
                    $relate_id = str_replace("/scholar?q=related:", "", $relate_id);
                    $relate_id = str_replace(":scholar.google.com/&amp;hl=vi&amp;oe=ASCII&amp;as_sdt=0,5", "", $relate_id);
                }
                if($cluster_id == ""){
                    if(strpos($aTag->href, "/scholar?cluster=") !== false){
                        $cluster_id = $aTag->href;
                        $cluster_id = str_replace("/scholar?cluster=","",$cluster_id);
                        $cluster_id = str_replace("&hl=vi&as_sdt=0,5","",$cluster_id);
                        $cluster_id = str_replace("&hl=vi&oe=ASCII&as_sdt=0,5", "", $cluster_id);
                    }

                    
                    if(strpos($aTag->href, "/scholar?cites=") !== false){
                        $cluster_id = $aTag->href;
                        $cluster_id = str_replace("/scholar?cites=","",$cluster_id);
                        $cluster_id = str_replace("&amp;as_sdt=2005&amp;sciodt=0,5&amp;hl=vi&amp;oe=ASCII","",$cluster_id);
                        $cluster_id = str_replace("&hl=vi&oe=ASCII&as_sdt=0,5", "", $cluster_id);
                    }
                }
            }


            $query = "https://scholar.google.com.vn/scholar?q=info:".$relate_id.":scholar.google.com/&output=cite&scirp=0&hl=vi";
            $rs = file_get_html($query);
            $mla = $rs->find('div[id="gs_cit0"]')[0];
            $apa = $rs->find('div[id="gs_cit1"]')[0];
            $iso = $rs->find('div[id="gs_cit2"]')[0];
         
            $article = new Article();
            $article->name = $nameArticle;
            $article->cluster_id = $cluster_id;
            $article->mla = utf8_encode($mla->plaintext);
            $article->apa = utf8_encode($apa->plaintext);
            $article->iso = utf8_encode($iso->plaintext);
            $article->save();

            return view('result')->with('article', $article);
        }else{
            return view('result')->with('article', $articleNeedInfo);
        }
    }

}
