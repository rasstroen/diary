<xsl:template match="authors_module[@action ='show' and not(@mode)]">
  <div class="authors-show module">
    <div class="authors-show-image">
			<img src="{author/@picture}" alt="[Image]"/>
    </div>
  	<div class="authors-show-text">
      <h1>
        <xsl:call-template name="helpers-author-name">
          <xsl:with-param name="author" select="author"/>
        </xsl:call-template>
      </h1>
      <a href="{&page;/@current_url}edit">редактировать автора</a>
      <div class="authors-show-text-bio-short">
        <noindex><xsl:value-of select="author/bio/@short" disable-output-escaping="yes"/></noindex>
      </div>
      <div class="authors-show-text-bio-full" style="display:none">
        <xsl:value-of select="author/bio/@html" disable-output-escaping="yes"/>
      </div>
      <a class="authors-show-text-bio-toggl" href="#">Показать полную биографию</a>
			<script>
        $('.authors-show-text-bio-toggl').bind('click', function(){
          $('.authors-show-text-bio-full').toggle();
          $('.authors-show-text-bio-short').toggle();
        });
			</script>
  	</div>
  </div>
</xsl:template>
