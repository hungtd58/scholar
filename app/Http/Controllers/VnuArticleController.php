<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\JS;

use App\VnuArticle;

use Illuminate\Support\Facades\Input;

require_once "simple_html_dom.php";

class VnuArticleController extends Controller
{

    public function detail($id){
        $allLink = array();
        $cluster_id = "";
        $relate_id = "";
        $js = JS::where("id", $id)->first();
        $articleNeedInfo = VnuArticle::where("js_article_id", $id)->first();

        if($articleNeedInfo == null){
            $query = "https://scholar.google.com.vn/scholar?q=".urlencode($js->title." ".$js->author)."&btnG=&hl=vi&as_sdt=0%2C5";

            $rs = file_get_html($query);
            $div = $rs->find('div[class="gs_r"]')[0];
            $div1 = $div->find('div[class="gs_ri"]')[0];
            $div2 = $div1->find('div[class="gs_fl"]')[0];
            $aTags = $div2->find('a');
            foreach ($aTags as $aTag) {
                array_push($allLink, $aTag->href);
                if($aTag->onclick != null && strpos($aTag->onclick, "gs_ocit") !== false){
                    $relate_id = $aTag->onclick;
                    $relate_id = str_replace("return gs_ocit(event,'", "", $relate_id);
                    $relate_id = str_replace("','0')", "", $relate_id);
                }
                if($cluster_id == ""){
                    if(strpos($aTag->href, "?cluster=") !== false){
                        $cluster_id = $aTag->href;
                        $cluster_id = str_replace("/scholar?cluster=","",$cluster_id);
                        $cluster_id = str_replace("&hl=vi&as_sdt=0,5","",$cluster_id);
                        $cluster_id = str_replace("&amp;hl=vi&amp;oe=ASCII&amp;as_sdt=0,5", "", $cluster_id);
                    }
                }
                if($cluster_id == ""){
                    if(strpos($aTag->href, "?cites=") !== false){
                        $cluster_id = $aTag->href;
                        $cluster_id = str_replace("/scholar?cites=","",$cluster_id);
                        $cluster_id = str_replace("&hl=vi&as_sdt=0,5","",$cluster_id);
                        $cluster_id = str_replace("&amp;hl=vi&amp;oe=ASCII&amp;as_sdt=0,5", "", $cluster_id);
                    }
                }
            }

            $query = "https://scholar.google.com.vn/scholar?q=info:".$relate_id.":scholar.google.com/&output=cite&scirp=0&hl=vi";
            $rs = file_get_html($query);
            $mla = $rs->find('div[id="gs_cit0"]')[0];
            $apa = $rs->find('div[id="gs_cit1"]')[0];
            $iso = $rs->find('div[id="gs_cit2"]')[0];
            
            if($articleNeedInfo == null){
                $article = new VnuArticle();
                $article->js_article_id = $id;
                $article->cluster_id = $cluster_id;
                $article->mla = utf8_encode($mla->plaintext);
                $article->apa = utf8_encode($apa->plaintext);
                $article->iso = utf8_encode($iso->plaintext);
                $article->save();                
                return view('result_update')->with(['article' => $article, 'js' => $js]);
            }
        }else{
            return view('result_update')->with(['article' => $articleNeedInfo , 'js' => $js]);
        }
    }
}
