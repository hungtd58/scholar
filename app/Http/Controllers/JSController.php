<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\JS;

use App\VnuArticle;

use Illuminate\Support\Facades\Input;

require_once "simple_html_dom.php";

class JSController extends Controller
{

    public function home(){
        $articles = JS::paginate(10);
        return view('CiteSeerX')->with('articles', $articles);
    }

    public function search(){
        $q = Input::get('q', 'default_query');
        $articles = JS::where('title', 'LIKE', '%'.$q.'%')
                        ->orWhere('author', 'LIKE', '%'.$q.'%')
                        ->get();

        $vnu_articles = array();
        foreach ($articles as $article) {
            $allLink = array();
            $cluster_id = "";
            $relate_id = "";
            $cites = 0;
            $gs_article = VnuArticle::where('js_article_id', $article->id)->first();
            if($gs_article == null){
                $query = "https://scholar.google.com.vn/scholar?q=".urlencode($article->title);
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
                            $cluster_id = str_replace("&amp;","",$cluster_id);
                            $cluster_id = str_replace("hl=en","",$cluster_id);
                            $cluster_id = str_replace("hl=vi","",$cluster_id);
                            $cluster_id = str_replace("as_sdt=0,5","",$cluster_id);
                            $cluster_id = str_replace("sciodt=0,5","",$cluster_id);
                            $cluster_id = str_replace("oe=ASCII","",$cluster_id);
                            $cluster_id = str_replace("as_sdt=2005","",$cluster_id);
                        }
                    }

                    if(strpos($aTag->href, "?cites=") !== false){
                        $number_cite = utf8_encode($aTag->innertext);
                        $number_cite = str_replace("Cited by ", "", $number_cite);
                        $number_cite = str_replace("Trích d&#7851;n ", "", $number_cite);
                        $number_cite = str_replace(" bài vi&#7871;t", "", $number_cite);
                        $cites = (int) $number_cite;
                    }
                }

                $query = "https://scholar.google.com.vn/scholar?q=info:".$relate_id.":scholar.google.com/&output=cite&scirp=0&hl=vi";
                $rs = file_get_html($query);
                $mla = $rs->find('div[id="gs_cit0"]')[0];
                $apa = $rs->find('div[id="gs_cit1"]')[0];
                $iso = $rs->find('div[id="gs_cit2"]')[0];
                
                $new_gs_article = new VnuArticle();
                $new_gs_article->js_article_id = $article->id;
                $new_gs_article->cluster_id = $cluster_id;
                $new_gs_article->cites = $cites;
                $new_gs_article->mla = utf8_encode($mla->plaintext);
                $new_gs_article->apa = utf8_encode($apa->plaintext);
                $new_gs_article->iso = utf8_encode($iso->plaintext);
                $new_gs_article->save();  

                array_push($vnu_articles, $new_gs_article);     
            }else{
                array_push($vnu_articles, $gs_article);
            }
        }
        return view('CiteSeerXResult')->with(['articles' => $articles, 'vnu_articles' => $vnu_articles, 'q' =>$q, "citation" => ""]);
    }

    public function detail($id){
        $allLink = array();
        $cluster_id = "";
        $relate_id = "";
        $cites = 0;

        $jsArticle = JS::findOrFail($id);
        $nameArticle = $jsArticle->title;
        
        $articleNeedInfo = VnuArticle::where("js_article_id", $id)->first();

        if($articleNeedInfo == null){
            $query = "https://scholar.google.com.vn/scholar?q=".urlencode($nameArticle);

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
                            $cluster_id = str_replace("&amp;","",$cluster_id);
                            $cluster_id = str_replace("hl=en","",$cluster_id);
                            $cluster_id = str_replace("hl=vi","",$cluster_id);
                            $cluster_id = str_replace("as_sdt=0,5","",$cluster_id);
                            $cluster_id = str_replace("sciodt=0,5","",$cluster_id);
                            $cluster_id = str_replace("oe=ASCII","",$cluster_id);
                            $cluster_id = str_replace("as_sdt=2005","",$cluster_id);
                    }
                }

                if(strpos($aTag->href, "?cites=") !== false){
                    $number_cite = utf8_encode($aTag->innertext);
                    $number_cite = str_replace("Cited by ", "", $number_cite);
                    $number_cite = str_replace("Trích d&#7851;n ", "", $number_cite);
                    $number_cite = str_replace(" bài vi&#7871;t", "", $number_cite);
                    $cites = (int) $number_cite;
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
                $article->cites = $cites;
                $article->mla = utf8_encode($mla->plaintext);
                $article->apa = utf8_encode($apa->plaintext);
                $article->iso = utf8_encode($iso->plaintext);
                $article->save();                
                return view('result_update')->with(['article' => $article, 'jsArticle' => $jsArticle]);
            }
        }else{
            return view('result_update')->with(['article' => $articleNeedInfo, 'jsArticle' => $jsArticle]);
        }
    }
}
