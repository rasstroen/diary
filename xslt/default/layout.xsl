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
    <div class="l-header">
      <xsl:apply-templates select="&root;" mode="l-header" />
    </div>
    <div class="l-wrapper">
      <div class="l-content">
        <xsl:apply-templates select="&root;" mode="l-content" />
      </div>
      <div class="l-sidebar">
        <xsl:apply-templates select="&root;" mode="l-sidebar" />
      </div>
    </div>
    <div class="l-footer">
      <xsl:apply-templates select="&root;" mode="l-footer" />
      <xsl:call-template name="l-debug"></xsl:call-template>
    </div>
  </body>
</xsl:template>

<xsl:template match="*" mode="l-header">
  <div class="l-header-logo">
    <h1><a href="{&prefix;}">Либрусек</a></h1>
  </div>
  <div class="l-header-auth">
    <xsl:apply-templates select="users_module[@action ='show' and @mode='auth']" />
  </div>
  <div class="l-header-search">
		<xsl:apply-templates select="&root;" mode="l-header-search" />
  </div>
  <div class="l-header-nav">
		<xsl:apply-templates select="&root;" mode="l-header-nav" />
  </div>
</xsl:template>

<xsl:template match="*" mode="l-content">
		контент по умолчанию
</xsl:template>

<xsl:template match="*" mode="l-sidebar">
  <a href="{&prefix;}book/new">Добавить книгу</a>
  <a href="{&prefix;}author/new">Добавить автора</a>
</xsl:template>

<xsl:template match="*" mode="l-footer">
  <div class="l-footer-nav">
		<xsl:apply-templates select="&root;" mode="l-footer-nav" />
  </div>
</xsl:template>

<xsl:template match="*" mode="l-header-search">
  <input id="" name="search_text" type="text" />
</xsl:template>

<xsl:template match="*" mode="l-header-nav">
  <ul>
    <p><a href="{&prefix;}books">Книги</a></p>
    <li><a href="{&prefix;}new">Новые</a></li>
    <li><a href="{&prefix;}popular">Популярные</a></li>
    <li><a href="{&prefix;}authors">Авторы</a></li>
    <li><a href="{&prefix;}genres">Жанры</a></li>
    <li><a href="{&prefix;}series">Серии</a></li>
  </ul>
  <ul>
    <p><a href="{&prefix;}">Клуб</a></p>
    <li><a href="{&prefix;}forum">Форум</a></li>
    <li><a href="{&prefix;}">Активность</a></li>
    <li><a href="{&prefix;}">Вычитка</a></li>
  </ul>
  <ul>
    <p><a href="{&prefix;}">Абонемент</a></p>
    <li><a href="{&prefix;}">Оплатить</a></li>
    <li><a href="{&prefix;}">Заработать</a></li>
  </ul>
</xsl:template>

<xsl:template match="*" mode="l-footer-nav">
  <ul>
    <li><a href="">Условия использования</a></li>
    <li><a href="">О проекте</a></li>
    <li><a href="">Помощь</a></li>
    <li><a href="">Правила</a></li>
  </ul>
</xsl:template>

<xsl:template name="l-debug">
  <div class="l-debug">
    <h2>Debuggg</h2>
    <a href="{&page;/@current_url}serxml" target="_blank">serxml</a>
    <a href="{&page;/@current_url}serxsl" target="_blank">serxsl</a>
  </div>
</xsl:template>
