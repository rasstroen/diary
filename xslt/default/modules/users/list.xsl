<xsl:template match="users_module[@action='list']">
  <xsl:call-template name="users-list"/>
</xsl:template>

<xsl:template name="users-list" match="*">
	<xsl:param name="users" select="users"/>
	<xsl:param name="amount" select="4"/>
  <ul class="users-list module">
    <h2>
      <xsl:value-of select="$users/@title"/>
      <xsl:if test="$users/@count"> (<xsl:value-of select="$users/@count"/>)</xsl:if>
    </h2>
    <xsl:apply-templates select="users/item[not (position()>$amount)]" mode="users-user" />
    <xsl:if test="$users/@link_title and $users/@link_url">
      <div class="users-list-link">
        <a href="{&prefix;}{$users/@link_url}">
          <xsl:value-of select="$users/@link_title"></xsl:value-of>
        </a>
      </div>
    </xsl:if>
  </ul>
</xsl:template>

<xsl:template match="*" mode="users-user">
  <li class="users-list-item">
		<a href="{&prefix;}user/{@id}"><img src="{@picture}" alt="[Image]"/></a>
    <p class="users-list-item-name">
      <a href="{&prefix;}user/{@id}">
        <xsl:value-of select="@nickname" />
      </a>
    </p>
  </li>
</xsl:template>
