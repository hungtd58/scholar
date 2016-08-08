<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GsArticle;

use App\Citation;

use App\JS;

use App\VnuArticle;

require_once "simple_html_dom.php";

class GsArticleController extends Controller
{
    public function citation($cluster_id_vnu){
        $js_article_id = VnuArticle::where('cluster_id', $cluster_id_vnu)->first()->js_article_id;
        $title_vnu = JS::findOrFail( $js_article_id)->title;
        $id_vnu = VnuArticle::where('cluster_id', $cluster_id_vnu)->first()->id;
        $citation_article = Citation::where('to_id', $id_vnu)->get();
        if(sizeof($citation_article) != 0){
            $articles = array();
            foreach ($citation_article as $citation) {
                array_push($articles, GsArticle::where('id', $citation->from_id)->first());
            }
            return view('CiteSeerXResult')->with(['articles' => $articles, 'vnu_articles' => $articles, 'q' =>"", "citation" => $title_vnu]);
        }
        $gs_articles = array();
        $query = "https://scholar.google.com.vn/scholar?cites=".$cluster_id_vnu;
        $rs = file_get_html($query);
        $gs_ri = $rs->find('div[class="gs_ri"]');
        foreach ($gs_ri as $item) {
            $pos = array_search($item, $gs_ri);
            $gs_title = $item->find('h3 a')[0]->innertext;
            $gs_author = $item->find('div[class="gs_a"]')[0]->innertext;
            $gs_uri = $item->find('h3 a')[0]->href;
            
            $allLink = array();
            $cluster_id = "";
            $relate_id = "";
            $cites = 0;
            $aTags = $item->find('div[class="gs_fl"] a');
            foreach ($aTags as $aTag) {
                array_push($allLink, $aTag->href);
                if($aTag->onclick != null && strpos($aTag->onclick, "gs_ocit") !== false){
                    $relate_id = $aTag->onclick;
                    $relate_id = str_replace("return gs_ocit(event,'", "", $relate_id);
                    $relate_id = str_replace("','".$pos."')", "", $relate_id);
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
            
            $new_gs_article = new GsArticle();
            $new_gs_article->title = $gs_title;
            $new_gs_article->author = $gs_author;
            $new_gs_article->uri = $gs_uri;
            $new_gs_article->cluster_id = $cluster_id;
            $new_gs_article->cites = $cites;
            $new_gs_article->mla = utf8_encode($mla->plaintext);
            $new_gs_article->apa = utf8_encode($apa->plaintext);
            $new_gs_article->iso = utf8_encode($iso->plaintext);
            $new_gs_article->save();  

            array_push($gs_articles, $new_gs_article);    
        }
        foreach ($gs_articles as $gs_article) {
            $citation = new Citation();
            $citation->to_id = $id_vnu;
            $citation->from_id = $gs_article->id;
            $citation->save();
        }
        return view('CiteSeerXResult')->with(['articles' => $gs_articles, 'vnu_articles' => $gs_articles, 'q' =>"", "citation" => $title_vnu]);
    }
}
