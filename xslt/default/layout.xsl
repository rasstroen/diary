
<xsl:template match="&page;" mode="l-head">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>
        <xsl:value-of select="@title"></xsl:value-of>
    </title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	
    <xsl:apply-templates select="css" mode="stylesheets" />
</xsl:template>
<xsl:template match="*" mode="stylesheets">
    <link rel="stylesheet" href="{./@path}" ></link>
</xsl:template>
<xsl:template match="&root;">
    <head>
        <xsl:apply-templates select="&page;" mode="l-head" />
    </head>
    <body class="l-body">
		
        <div class="l-wrapper">
            <div class="l-header">
                <xsl:apply-templates select="&root;" mode="l-header" />
            </div>
            <div class="l-sidebar">
                <xsl:apply-templates select="&root;" mode="l-sidebar" />
            </div>
            <div class="l-content">
                <xsl:apply-templates select="&root;" mode="l-content" />
            </div>
        </div>
        <div class="l-footer">
            <xsl:apply-templates select="&root;" mode="l-footer" />
        </div>
    </body>
</xsl:template>

<xsl:template match="*" mode="l-header">
    <div class="l-header-auth">
        <xsl:apply-templates select="users_module[@action ='show' and @mode='auth']" />
    </div>
    <div class="l-header-nav">
        <xsl:apply-templates select="&root;" mode="l-header-nav" />
    </div>
</xsl:template>

<xsl:template match="*" mode="l-content">
    контент по умолчанию
</xsl:template>

<xsl:template match="*" mode="l-sidebar">
	
</xsl:template>

<xsl:template match="*" mode="l-footer">
    <div class="l-footer-nav">
        <xsl:apply-templates select="&root;" mode="l-footer-nav" />
    </div>
</xsl:template>

<xsl:template match="*" mode="l-header-search">
  
</xsl:template>

<xsl:template match="*" mode="l-header-nav">
    <ul>
        <li>
            <a class="l-header-nav link-main" href="/">
                <xsl:if test="&page;/@url = ''">
                    <xsl:attribute name="class">
                        <xsl:text>l-header-nav link-main selected</xsl:text>
                    </xsl:attribute>
                </xsl:if>
            </a>
        </li>
        <li>
            <a class="l-header-nav link-pictures" href="/pictures">
                <xsl:if test="&page;/@url = 'pictures'">
                    <xsl:attribute name="class">
                        <xsl:text>l-header-nav link-pictures selected</xsl:text>
                    </xsl:attribute>
                </xsl:if>
            </a>
        </li>
        <li>
            <a class="l-header-nav link-video" href="/video">
                <xsl:if test="&page;/@url = 'video'">
                    <xsl:attribute name="class">
                        <xsl:text>l-header-nav link-video selected</xsl:text>
                    </xsl:attribute>
                </xsl:if>
            </a>
        </li>
        <li>
            <a class="l-header-nav link-music" href="/music">
                <xsl:if test="&page;/@url = 'music'">
                    <xsl:attribute name="class">
                        <xsl:text>l-header-nav link-music selected</xsl:text>
                    </xsl:attribute>
                </xsl:if>
            </a>
        </li>
    </ul>
</xsl:template>

<xsl:template match="*" mode="l-footer-nav">
    <xsl:text disable-output-escaping="yes">
        &lt;div class="l-counter item">
    &lt;script type="text/javascript">
    document.write("&lt;a href='http://www.liveinternet.ru/click' "+
    "target=_blank>&lt;img src='//counter.yadro.ru/hit?t14.4;r"+
    escape(document.referrer)+((typeof(screen)=="undefined")?"":
        ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
    ";h"+escape(document.title.substring(0,80))+";"+Math.random()+
    "' alt='' title='LiveInternet: показано число просмотров за 24"+
    " часа, посетителей за 24 часа и за сегодня' "+
    "border='0' width='88' height='31'>&lt;\/a>")
    &lt;/script>
        &lt;/div>
        &lt;div class="l-counter item">
            &lt;script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2568761">&lt;/script>
            &lt;noscript>
                &lt;a href="http://top100.rambler.ru/navi/2568761/">
                    &lt;img src="http://counter.rambler.ru/top100.cnt?2568761" alt="Rambler's Top100" border="0" />
                &lt;/a>
            &lt;/noscript>
        &lt;/div>
    </xsl:text>
</xsl:template>
