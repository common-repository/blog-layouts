<?php header("Content-type: text/css"); ?>
<?php include( '../../../../wp-load.php' );?>
<?php $settings							=	get_option( "wp_blog_layouts_settings" );?>
<?php $background						=	$settings['template_bgcolor'];?>
<?php $color							=	$settings['template_ftcolor'];?>

/************************************* lightbreeze style *********************************/
.blog_template{
	float:left;
	width:100%;
	margin-bottom:20px;
	border-radius: 3px 3px 3px 3px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
	background:<?php echo $background;?>;
	padding:5px;
	border:1px solid #ccc;
}
.blog_header{
	overflow:hidden;
}
.blog_header img{
	box-shadow:none;
    width:100%;
}
.blog_header h1{
	display:block;
	padding:3px 10px;
	background:<?php echo $color;?>;
	margin:0;
	border-radius: 3px;
    line-height:17px;ss
}
.blog_header h1 a{
	text-decoration:none;
	text-transform:uppercase;
	color:<?php echo $background;?>;
	line-height:21px;
}
.metadatabox {
	float:left;
	margin:10px 0;
	border-bottom: 1px solid #CCCCCC;
	width: 100%;
	font-style:italic;
}
.metadatabox [class^="icon-"], .metadatabox [class*=" icon-"], .tags [class^="icon-"], .tags [class*=" icon-"] {
	background: url( ../images/glyphicons-halflings.png ) no-repeat 14px 14px;
	display: inline-block;
	height: 14px;
	line-height: 14px;
	vertical-align: text-top;
	width: 14px;
}
.metadatabox .metadate {
	border-right: 1px solid #CCCCCC;
	float: left;
	min-height: 48px;
	padding: 0 0 0 10px;
	width: 25%;
}
.metadatabox .metacats {
	border-right: 1px solid #CCCCCC;
	float: left;
	padding: 0 10px 0 10px;
	width: 45%;
	min-height: 48px;
}
.metadatabox .metacats a {
	text-decoration:none;
	color:<?php echo $color;?>;
}
.metadatabox .metacomments {
	float: left;
	padding-left: 10px;
	width: 30%x;
}
.metadatabox .metacomments a {
	text-decoration:none;
	color:<?php echo $color;?>;
}
.metadatabox .icon-author {
	background-position: -168px 1px;
	margin-right:5px;
}
.metadatabox span {
	color:#F78F08;
}
.metadatabox span.mdate {
	color:#6D6D6D;
	margin-left:18px;
	font-size:12px;
}
.metadatabox .icon-cats {
	background-position: -49px -47px;
}
.metadatabox .icon-comment {
	background-position: -241px -119px;
}
.tags {
	background:<?php echo $color;?>;
	color:<?php echo $background;?>;
	padding:5px 10px;
	border-radius: 3px;
}
.tags .icon-tags {
	background-position: -25px -47px;
}
.tags a {
	color:<?php echo $background;?>;
	text-decoration:none;
}
.post_content a{
	display:inline-block;
	border-radius:12px;
	background:<?php echo $color;?>;
	color:<?php echo $background;?>;
	padding:0 15px;
	text-decoration:none;
	font-size:13px;
	font-style:italic;
}
.post_content a:hover{
	background:<?php echo $background;?>;
	color:<?php echo $color;?>;
}
.wl_pagination_box.lightbreeze .wl_pagination span, .wl_pagination_box.lightbreeze .wl_pagination a{
    border-radius: 2px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}
/******************************** classical style ************************************/

.blog_template.classical{
    background: none;
    border:none;
    border-bottom: 1px dashed rgb(204, 204, 204);
    border-radius: 0px;
    box-shadow: none;
    float: left;
    margin-bottom: 20px;
    padding: 5px;
    width: 100%;
}
.classical .blog_header img{
	box-shadow:none;
    width:30%;
    float:left;
	margin-right:10px;
}

.classical .blog_header h1{
	display:inline;
	background:none;
	border-radius:0px;
    padding:0;
    line-height:17px;
}
.classical .blog_header h1 a{
    color:<?php echo $color;?>;
}
.classical .blog_header .metadatabox{
	border-bottom: none;
    float: none;
    font-size: 13px;
    font-style:italic;
    margin: 5px 0;
    width: 100%;
}
.classical .blog_header .metadatabox .metacomments{
	float:right;
    background:<?php echo $background;?>;
    padding: 2px 5px;
    border-radius:5px;
}
.classical .blog_header .metadatabox .icon-date {
    background-position: -48px -24px;
    margin-right: 3px;
}
.classical .blog_header .tags{
    background: none;
    border-radius: 0px;
    padding: 0px;
    color: <?php echo $color;?>;
}
.classical .blog_header .tags a{
    color: <?php echo $color;?>;
    font-size: 13px;
}
.wl_pagination_box{
	float: left;
    width: 100%;
}
.wl_pagination_box .wl_pagination span, .wl_pagination_box .wl_pagination a{
    background: <?php echo $background;?>;
    display: inline-block;
    padding: 0 8px;
    color:<?php echo $color;?>;
    text-decoration:none;
    margin-right:5px;
}
.wl_pagination_box .wl_pagination span.current, .wl_pagination_box .wl_pagination a:hover{
    background: <?php echo $color;?>;
    color:<?php echo $background;?>;
}

/******************************** spektrum style ************************************/
.blog_template.spektrum{
    background: none;
    border: none;
    border-radius: 0px;
    box-shadow: none;
    padding: 0px;
}
.spektrum img {
    box-shadow: none;
    border-radius: 0px;
    float:left;
    width:100%;
}
.spektrum .date {
    background: #212121;
    color: <?php echo $background;?>;
    display: block;
    float: left;
    font-size: 10px;
    margin: 5px;
    text-align: center;
    text-transform: uppercase;
    padding:5px;
}
.spektrum .number-date {
    display: block;
    font-size: 20px;
    line-height:14px;
    background: #212121;
    color: <?php echo $background;?>;
    padding:3px 5px;
}
.spektrum .blog_header{
    background: <?php echo $background;?>;
    box-shadow: 0 3px 5px rgba(196, 196, 196, 0.3);
    width:100%;
    position: relative;
}
.spektrum .blog_header h1{
    background: none;
    border-radius: 0px;
    display: inline-block;
    line-height: 17px;
    margin: 0;
    padding: 3px 10px;
}
.spektrum .blog_header h1 a{
    color: <?php echo $color;?>;
}
.spektrum .post_content{
    background: none <?php echo $background;?>;
    padding: 10px;
}
.spektrum .post_content p{
    margin: 0;
    padding:0px;
}
.spektrum .post-bottom {
    box-shadow: 0 -2px 5px rgba(196, 196, 196, 0.3);
    margin: 0 auto;
    padding: 10px 15px;
    background: none <?php echo $background;?>;
    clear: both;
    margin: 0px;
    position: relative;
}
.spektrum .post-bottom .categories {
    color: <?php echo $color;?>;
    display: inline-block;
    text-transform: uppercase;
}
.spektrum .post-bottom .categories a{
    color: <?php echo $color;?>;
    text-decoration: none;
}
.spektrum .post_content a{
	display: none;
}   
.spektrum .details a {
    color: inherit;
    display: inline-block;
    float: right;
    padding-right: 10px;
    text-decoration: none;
    text-transform: uppercase;
}
.wl_pagination_box.spektrum .wl_pagination span, .wl_pagination_box.spektrum .wl_pagination a{
    display: inline-block;
    padding: 2px 10px;
    color:#fff;
    text-decoration:none;
    margin-right:0px;
}
.wl_pagination_box.spektrum .wl_pagination span{
    background: #212121;
}
.wl_pagination_box.spektrum .wl_pagination a{
	background: none;
    color: #212121;
}
.wl_pagination_box.spektrum .wl_pagination span.current{
    background: <?php echo $background;?>;
    color:<?php echo $color;?>;
}
.wl_pagination_box.spektrum .wl_pagination a:hover{
    color:<?php echo $color;?>;
}

/******************************** evolution style ************************************/
.blog_template.evolution{
    background: none;
    border: none;
    border-radius: 0px;
    box-shadow: none;
    padding: 0px;
}
.evolution img {
    box-shadow: none;
    border-radius: 0px;
    float:left;
    width:100%;
}
.evolution .date {
    background: #212121;
    color: <?php echo $background;?>;
    display: block;
    float: left;
    font-size: 10px;
    margin: 0px;
    text-align: center;
    text-transform: uppercase;
    padding:10px;
    width: 6%;
}
.evolution .number-date {
    display: block;
    font-size: 20px;
    line-height:14px;
    background: #212121;
    color: <?php echo $color;?>;
    padding:3px 5px;
}
.evolution .comment{
	background: url(../images/comment.png) no-repeat 50% 50% #212121;
    height: 57px;
    width: 58px;
    float:left;
}
.evolution .icon_cnt{
    display: block;
    font-size: 16px;
    line-height: 50px;
    text-align: center;
}
.evolution .icon_cnt a{
    color: <?php echo $color;?>;
    text-decoration:none;
}
.evolution .blog_header{
    background: <?php echo $background;?>;
    width:100%;
    position: relative;
}
.evolution .blog_header .title{
    float:left;
    width:81.5%;
    width:81.45%\0/;
}
.evolution .blog_header h1{
    background: none;
    border-radius: 0px;
    display: block;
    line-height: 23px;
    padding: 3px 10px;
    border-bottom: 1px dotted #CCCCCC;
    margin:0 0 5px 0;
}
.evolution .blog_header h1 a{
    color: <?php echo $color;?>;
    text-transform:none;
}
.evolution .blog_header .title .metadate{
    font-size: 12px;
    font-style: italic;
    padding: 0 10px;
}
.evolution .blog_header .title .metadate a{
	color: <?php echo $color;?>;
}
.evolution .blog_header .title .metadate a:hover{
    color: #212121;
    text-decoration:none;
}
.evolution .blog_header .title .metadate span.author, .evolution .blog_header .title .metadate span.time{
    color: <?php echo $color;?>;
}
.evolution .post_content{
    background: none ;
    padding: 10px;
	border:2px solid <?php echo $background;?>;
    border-bottom:none;
}
.evolution .post_content p{
    margin: 0;
    padding:0px;
}
.evolution .post-bottom {
    background: <?php echo $background;?>;
    float: left;
    width: 100%;
}
.evolution .post-bottom a{
    background: <?php echo $color;?>;
    color: <?php echo $background;?>;
    float: right;
    padding: 5px 10px;
    text-decoration: none;
}
.evolution .post-bottom .categories {
    color: <?php echo $color;?>;
    display: inline-block;
    text-transform: uppercase;
}
.evolution .post-bottom .categories a{
    color: <?php echo $color;?>;
    text-decoration: none;
}
.evolution .post_content a{
	display: none;
}   
.evolution .details a {
    color: inherit;
    display: inline-block;
    float: right;
    padding-right: 10px;
    text-decoration: none;
    text-transform: uppercase;
}
.wl_pagination_box.evolution{
	background: #212121;
    padding: 8px;
    width: 97.5%;
}
.wl_pagination_box.evolution .wl_pagination{
    float: right;
}
.wl_pagination_box.evolution .wl_pagination span, .wl_pagination_box.evolution .wl_pagination a{
    display: inline-block;
    padding: 2px 10px;
    color:#fff;
    text-decoration:none;
    margin:0 0 0 8px;
}
.wl_pagination_box.evolution .wl_pagination span{
    background: <?php echo $background;?>;
    color:#212121;
}
.wl_pagination_box.evolution .wl_pagination a{
	background: <?php echo $background;?>;
    color: #212121;
}
.wl_pagination_box.evolution .wl_pagination span.current{
    background: <?php echo $color;?>;
    color:<?php echo $background;?>;
}
.wl_pagination_box.evolution .wl_pagination a:hover{
    color:<?php echo $color;?>;
}