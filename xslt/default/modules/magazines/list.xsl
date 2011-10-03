<xsl:template match="magazines_module[@action='list']">
  <xsl:param name="amount" select="20"/>
  <ul class="magazines-list module">
    <h1>Периодика</h1>
    <xsl:apply-templates select="magazines/item[not (position()>$amount)]" mode="magazines-list-item"/>
  </ul>
</xsl:template>

<xsl:template mode="magazines-list-item" match="*">
  <li class="magazines-list-item">
    <h2 class="magazines-list-item-title">
      <a href="{&prefix;}magazine/{@id}">      <xsl:value-of select="@title" /></a>
    </h2>
    <div class="magazines-list-item-years">
      <xsl:value-of select="@first_year" /> &mdash; <xsl:value-of select="@last_year" />
    </div>
  </li>
</xsl:template>
