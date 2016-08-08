<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0098)http://citeseerx.ist.psu.edu/search?q=quantum&submit.x=14&submit.y=12&submit=Search&sort=rlv&t=doc -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head profile="http://www.w3.org/2005/11/profile http://a9.com/-/spec/opensearch/1.1/">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta property="og:image" content="/images/csx_logo_front.png">

    <title>CiteSeerX — Search Results — quantum</title>


    <meta name="description" content="CiteSeerX - Scientific articles matching the query: quantum">


    <meta name="keywords" content="CiteSeerX, quantum">


    <link rel="shortcut icon" type="image/x-icon" href="http://citeseerx.ist.psu.edu/favicon.ico">

    <link rel="search" title="CiteSeerX" type="application/opensearchdescription+xml"
          href="http://citeseerx.ist.psu.edu/search_plugins/citeseerx_general.xml">
    <link rel="search" title="CiteSeerX Author" type="application/opensearchdescription+xml"
          href="http://citeseerx.ist.psu.edu/search_plugins/citeseerx_author.xml">
    <link rel="search" title="CiteSeerX Title" type="application/opensearchdescription+xml"
          href="http://citeseerx.ist.psu.edu/search_plugins/citeseerx_title.xml">


    <link rel="alternate" type="application/atom+xml" title="CiteSeerX Search Results - Atom"
          href="http://citeseerx.ist.psu.edu/search?q=quantum&amp;t=doc&amp;sort=rlv&amp;feed=atom">
    <link rel="alternate" type="application/rss+xml" title="CiteSeerX Search Results - RSS"
          href="http://citeseerx.ist.psu.edu/search?q=quantum&amp;t=doc&amp;sort=rlv&amp;feed=rss">


    <link type="text/css" rel="stylesheet" href="{{ url('resources/assets/js_search/main.css')}}">
    <script async="" src="{{ url('resources/assets/js_search/analytics.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/jquery-1.4.2.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/jquery-ui-1.8.custom.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/jquery.idTabs.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/metacart.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/topnav.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/citeseerx.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/correctionutils.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/checkboxes.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/ga.js')}}"></script>
    <script type="text/javascript" src="{{ url('resources/assets/js_search/s2button.js')}}"></script>


</head>
<body>
<div id="wrapper">


    <div id="topnav">

        <ul id="search_nav">


            <li class="active"><a class="slink"
                                  href="http://citeseerx.ist.psu.edu/search?q=quantum&amp;t=doc&amp;sort=rlv">Documents</a>
            </li>
            <li><a class="slink"
                   href="http://citeseerx.ist.psu.edu/search?q=quantum&amp;t=auth&amp;uauth=1&amp;sort=ndocs">Authors</a>
            </li>
            <li><a class="slink"
                   href="http://citeseerx.ist.psu.edu/search?q=quantum&amp;t=table&amp;sort=rlv">Tables</a></li>


            <li id="activeLine" style="width: 99px; left: 0px;"></li>
        </ul>


        <ul id="toptools">

            <li><a href="http://citeseerx.ist.psu.edu/myciteseer/login">Log in</a></li>
            <li><a href="http://citeseerx.ist.psu.edu/mcsutils/newAccount">Sign up</a></li>

            <li><a href="http://citeseerx.ist.psu.edu/metacart">MetaCart</a></li>
            <li><a href="http://www.givenow.psu.edu/CiteseerxFund"><font color="#045FB4">Donate</font></a></li>
        </ul>

    </div>

    <div id="header">
        <h1 id="title"><a href="./" title="CiteSeerX"><img
                        src="{{ url('resources/assets/js_search/csx_logo.png')}}" alt="CiteSeerX logo"
                        height="50%" width="50%"></a></h1>
    </div>


    <div id="main">
        <div id="search">


            <div id="search_docs">
                <form method="get" action="./search"
                      enctype="application/x-www-form-urlencoded">
                    <label style="display: none; visibility: hidden;">Documents:</label>
                    <input class="s_field" type="text" name="q" value="{{$q}}">
                    <input class="s_button" type="image" name="submit" value="Search" alt="Search"
                           src="{{ url('resources/assets/js_search/search_icon.png')}}">
                    <input class="s_button" type="image" name="s2" value="Semantic Scholar" alt="Semantic Scholar"
                           src="{{ url('resources/assets/js_search/s2_icon.png')}}">
                    <div class="opts">
                        <a href="http://citeseerx.ist.psu.edu/advanced_search"
                           title="Search full text, title, abstract, date, author name, author affiliation, etc.">Advanced
                            Search</a>
                        <input class="c_box" type="checkbox" name="ic" value="1"> Include Citations
                    </div>
                    <input type="hidden" name="sort" value="rlv">
                    <input type="hidden" name="t" value="doc">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                </form>
            </div>


        </div>

        <div id="content" class="sidebar">
            <div id="sidebar">
                <h3>Tools</h3>
                <!-- <div id="feeds">
                  <a href="/search?q=quantum&t=doc&sort=rlv&feed=rss"><img src="/images/rss.png" alt="RSS"/></a>
                </div> -->

                <div id="sorting">Sorted by:
                    <select name="sortvalue" id="sortvalue"
                            onchange="location = this.options[this.selectedIndex].value;" class="pulldown">
                        <option value="/search?q=quantum&amp;t=doc" selected="">Relevance</option>
                        <option value="/search?q=quantum&amp;t=doc&amp;sort=cite">Citation Count</option>
                        <option value="/search?q=quantum&amp;t=doc&amp;sort=date">Year (Descending)</option>
                        <option value="/search?q=quantum&amp;t=doc&amp;sort=ascdate">Year (Ascending)</option>

                        <option value="/search?q=quantum&amp;t=doc&amp;sort=recent">Recency</option>

                    </select>
                </div>

                <div id="qother">Try your query at:


                    <table border="0" cellspacing="5" cellpadding="5">
                        <tbody>
                        <tr>
                            <td><a href="https://www.semanticscholar.org/search?q=quantum"
                                   title="AllenAI Semantic Scholar"><img
                                            src="{{ url('resources/assets/js_search/ai2_icon.png')}}"
                                            alt="Semantic Scholar" height="30" width="30"></a></td>
                            <td><a href="http://scholar.google.com/scholar?q=quantum&amp;hl=en&amp;btnG=Search"
                                   title="Google Scholar"><img
                                            src="{{ url('resources/assets/js_search/googlescholar_icon.png')}}"
                                            alt="Scholar" height="24" width="24"></a></td>
                            <td>
                                <a href="http://academic.research.microsoft.com/Search.aspx?query=quantum&amp;submit=Search"
                                   title="Microsoft Academic Search"><img
                                            src="{{ url('resources/assets/js_search/microsoftacademicsearch_icon.jpg')}}"
                                            alt="Academic" height="24" width="24"></a></td>
                        </tr>
                        <tr>
                            <td><a href="https://www.google.com/search?q=quantum" title="Google"><img
                                            src="{{ url('resources/assets/js_search/google_icon.png')}}"
                                            alt="Google" height="24" width="24"></a></td>
                            <td><a href="http://www.bing.com/search?q=quantum" title="Bing"><img
                                            src="{{ url('resources/assets/js_search/bing_icon.ico')}}" alt="Bing"
                                            height="24" width="24"></a></td>
                            <td><a href="http://dblp.uni-trier.de/search?q=quantum"
                                   title="DBLP Computer Science Bibliography"><img
                                            src="{{ url('resources/assets/js_search/dblp_icon.png')}}" alt="DBLP"
                                            height="30" width="30"></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="result_list">
                @if($citation != "")
                    <h3>Các bài viết trích dẫn của {{$citation}}</h3>
                @endif
                @for($i = 0; $i < sizeof($articles); $i++)
                    <div class="result">
                        <h3>

                            <a class="remove doc_details"
                               href="{{$articles[$i]->uri}}">
                                <em>{{$articles[$i]->title}}</em>
                            </a>


                        </h3>
                        <div class="pubinfo">
                            <span class="authors">by {{$articles[$i]->author}}
                            </span>
                            <span class="pubvenue">- {{$articles[$i]->journal}}</span>
                        </div>
                        <div class="snippet" style="margin-top: 10px">
                            @if($vnu_articles[$i]->cluster_id != "")
                                <b>ClusterID trên google scholar: </b>
                                <p>{{$vnu_articles[$i]->cluster_id}}</p>
                            @endif
                            <b>MLA: </b>
                            <p>{{$vnu_articles[$i]->mla}}</p>

                            <b>APA: </b>
                            <p>{{$vnu_articles[$i]->apa}}</p>

                            <b>ISO: </b>
                            <p>{{$vnu_articles[$i]->iso}}</p>
                        </div>
                        @if($vnu_articles[$i]->cluster_id != "" && $citation == "")
                            <div class="pubextras">
                                <a class="citation remove" href="./gsarticles/{{$vnu_articles[$i]->cluster_id}}" title="number of citations">Citation {{$vnu_articles[$i]->cites}}</a>
                            </div>
                        @endif
                        <div class="pubtools">
                            <span class="Z3988"
                                  title="url_ver=Z39.88-2004&amp;url_ctx_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Actx&amp;ctx_ver=Z39.88-2004&amp;ctx_enc=info%3Aofi%2Fenc%3AUTF-8&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Ajournal&amp;rft_id=http%3A%2F%2Fciteseerx.ist.psu.edu%2Fviewdoc%2Fsummary%3Fdoi%3D10.1.1.144.7852&amp;rft.atitle=%3Cem%3EQuantum%3C%2Fem%3E+complexity+theory&amp;rft.jtitle=IN+PROC.+25TH+ANNUAL+ACM+SYMPOSIUM+ON+THEORY+OF+COMPUTING%2C+ACM&amp;rft.date=1993&amp;rft.pages=&amp;rft.genre=unknown&amp;rft.aulast=Bernstein&amp;rft.aufirst=+Ethan&amp;rft.au=Bernstein%2C+Ethan&amp;rft.au=Vazirani%2C+Umesh"></span>
                        </div>
                    </div>
                @endfor
                @if(sizeof($articles) == 0)
                    <h5>Không có dữ liệu</h5>
                @endif
            </div>

        </div>
        <div class="clear"></div>
    </div>
    <div id="footer">
        <div id="sponsors">
            <a href="http://www.nsf.gov/"><img src="{{ url('resources/assets/js_search/nsf_logo.gif')}}"
                                               alt="The National Science Foundation" height="8%" width="8%"></a>
            <br>
            Powered by:
            <a href="http://lucene.apache.org/solr/"><img
                        src="{{ url('resources/assets/js_search/solrlogo1.png')}}" alt="Apache Solr" height="8%"
                        width="8%"></a>
        </div>
        <ul class="links">
            <li><a href="http://csxstatic.ist.psu.edu/about" target="_blank">About CiteSeerX</a></li>
            <li><a href="http://csxcrawlweb01.ist.psu.edu/submit_pub/" target="_blank">Submit and Index Documents</a>
            </li>
            <li><a href="http://csxstatic.ist.psu.edu/privacy" target="_blank">Privacy Policy</a></li>
            <li><a href="http://csxstatic.ist.psu.edu/help" target="_blank">Help</a></li>
            <li><a href="http://csxstatic.ist.psu.edu/about/data" target="_blank">Data</a></li>
            <li><a href="https://github.com/SeerLabs/CiteSeerX" target="_blank">Source</a></li>
            <li><a href="http://csxstatic.ist.psu.edu/contact" target="_blank">Contact Us</a></li>
        </ul>
        <p class="info">Developed at and hosted by <a href="http://ist.psu.edu/">The College of Information Sciences and
                Technology</a></p>
        <p>© 2007-2016 <a href="http://www.psu.edu/">The Pennsylvania State University</a></p>
    </div>
</div>


</body>
</html>