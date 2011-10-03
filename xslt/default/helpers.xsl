<xsl:template name="helpers-author-name">
	<xsl:param name="author" select="author"/>
	<xsl:value-of select="$author/@first_name"/>
	<xsl:if test="$author/@middle_name!=''">
		<xsl:text> </xsl:text>
		<xsl:value-of select="$author/@middle_name"/>
	</xsl:if>
	<xsl:if test="($author/@middle_name!='') or ($author/@first_name!='')">
		<xsl:text> </xsl:text>
	</xsl:if>
	<xsl:value-of select="$author/@last_name"/>
</xsl:template>

<xsl:template name="helpers-lang-code-select">
	<xsl:param name="object" select="book"/>
	<select name="lang_code" class="lang-code-select">
    <xsl:for-each select="$object/lang_codes/item">
      <option value="{@code}">
        <xsl:if test="($object/@lang_id)=@id">
          <xsl:attribute name="selected"/>
        </xsl:if>
        <xsl:value-of select="@title"/> (<xsl:value-of select="@code"/>)
      </option>
    </xsl:for-each>
	</select>
	<input name="lang_code" class="lang-code-input" value="{$object/@lang_code}" />
	<script>
    $('.lang-code-select').bind('change', function(){
      $(".lang-code-input").val($(".lang-code-select").val());
    });
	</script>
</xsl:template>

<xsl:template name="helpers-role-select">
	<xsl:param name="object" select="book"/>
	<select name="role" class="role-select">
		<xsl:for-each select="$object/roles/item">
			<option value="{@id}">
				<xsl:value-of select="@title"/>
			</option>
		</xsl:for-each>
	</select>
</xsl:template>

<xsl:template name="helpers-this-amount">
  <xsl:param name="amount"/>
  <xsl:param name="words"/>
  <xsl:variable name="mod10" select="$amount mod 10"/>
  <xsl:variable name="f5t20" select="$amount>=5 and not($amount>20)"/>
  <xsl:choose>
    <xsl:when test="not($f5t20) and $mod10=1">
      <xsl:value-of select="$amount"/>&nbsp;<xsl:value-of select="substring-before($words,' ')"/>
    </xsl:when>
    <xsl:when test="not($f5t20) and (not($mod10>5) and $mod10>1)">
      <xsl:value-of select="$amount"/>&nbsp;<xsl:value-of select="substring-before(substring-after($words,' '),' ')"/>
    </xsl:when>
    <xsl:otherwise>
      <xsl:value-of select="$amount"/>&nbsp;<xsl:value-of select="substring-after(substring-after($words,' '),' ')"/>
    </xsl:otherwise>
  </xsl:choose>
</xsl:template>

<xsl:template name="helpers-abbr-time">
  <xsl:param name="time"/>
  <xsl:if test="$time">
    <abbr class="timeago" title="{$time}">
      <xsl:value-of select="$time"/>
    </abbr>
  </xsl:if>
</xsl:template>

<xsl:template match="*" mode="helpers-book-link">
  <a href="{&prefix;}b/{@id}"><xsl:value-of select="@title"/></a>
</xsl:template>

<xsl:template match="*" mode="helpers-author-link">
  <a href="{&prefix;}a/{@id}"><xsl:value-of select="@name"/></a>
</xsl:template>

<xsl:template match="*" mode="helpers-user-link">
  <a href="{&prefix;}user/{@id}"><xsl:value-of select="@nickname"/></a>
</xsl:template>

<xsl:template match="*" mode="helpers-user-image">
  <a href="{&prefix;}user/{@id}"><img src="{@picture}" alt="[{@nickname}]" /></a>
</xsl:template>
