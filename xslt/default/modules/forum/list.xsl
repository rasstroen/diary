<xsl:template match="forum_module[@action='list']">
	<xsl:for-each select="forums/item">
		<div>
			<a href="{&prefix;}forum/{@tid}">
				<xsl:value-of select="@name" />
			</a>
		</div>
	</xsl:for-each>
</xsl:template>

<xsl:template match="forum_module[@action='list' and @mode='themes']">
  <div class="forum-list module">
    <table class="forum-list-table">
      <tr><td>Тема</td><td>Ответов</td><td>Дата</td></tr>
      <xsl:apply-templates select="themes/item" mode="forum-list-item">
        <xsl:with-param select="users" name="users"/>
      </xsl:apply-templates>
    </table>
  </div>
</xsl:template>

<xsl:template match="*" mode="forum-list-item">
  <xsl:param select="users" name="users"/>
  <xsl:param select="@last_comment_uid" name="uid"/>
  <xsl:param select="$users/item[@id = $uid]" name="user"/>
  <tr>
    <xsl:attribute name="class">
      <xsl:text>forum-list-item </xsl:text>
      <xsl:choose>
        <xsl:when test="position() mod 2 = 1">odd</xsl:when>
        <xsl:otherwise>even</xsl:otherwise>
      </xsl:choose>
    </xsl:attribute>
    <td>
      <div class="forum-list-item-title">
        <a href="{&prefix;}forum/{../@tid}/{@nid}"><xsl:value-of select="@title"/></a>
      </div>
      <div class="forum-list-item-comment">
Последний комментарий: <xsl:value-of select="@last_comment_timestamp"/>, пользователь <a href="{&prefix;}user/{@uid}"><xsl:value-of select="$user/@nickname"/></a>
      </div>
    </td>	
    <td class="forum-list-item-count"><xsl:value-of select="@comment"/></td>	
    <td class="forum-list-item-created"><xsl:value-of select="@created"/></td>	
    <td>
    </td>	
  </tr>
</xsl:template>
