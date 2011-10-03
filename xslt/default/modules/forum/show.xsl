<xsl:template match="forum_module[@action='show']">
  <xsl:variable select="theme/@user_id" name="uid"/>
  <xsl:variable select="theme/users/item[@id=$uid]" name="user"/>
  <div class="forum-show module">
    <h1><xsl:value-of select="theme/@title"></xsl:value-of></h1>
		<div class="forum-show-back">
      <a href="{&prefix;}forum/{theme/@tid}">Назад, к списку тем</a>
		</div>
    <div class="forum-show-user">
      <div class="forum-show-user-image">
        <img src="{$user/@picture}" alt="[{$user/@nickname}]" />
      </div>
      <a href="{&prefix;}user/{$user/@id}">
        <xsl:value-of select="$user/@nickname"></xsl:value-of>
      </a>
    </div>
    <div class="forum-show-body">
      <xsl:value-of select="theme/@body" disable-output-escaping="yes"></xsl:value-of>
    </div>
    <ul class="forum-show-comments">
      <h2>Комментарии:</h2>
      <xsl:apply-templates select="theme/comments/item" mode="forum-show-comments-item">
        <xsl:with-param select="theme/users" name="users"/>
      </xsl:apply-templates>
    </ul>
  </div>
</xsl:template>

<xsl:template match="*" mode="forum-show-comments-item">
  <xsl:param select="users" name="users"/>
  <xsl:param select="@uid" name="uid"/>
  <xsl:variable select="$users/item[@id=$uid]" name="user"/>
  <li class="forum-show-comments-item">
    <div class="forum-show-comments-item-image">
      <img src="{$user/@picture}" alt="[{$user/@nickname}]" />
    </div>
    <div class="forum-show-comments-item-text">
      <div class="forum-show-comments-item-text-user">
        <a href="{&prefix;}user/{$user/@id}">
          <xsl:value-of select="$user/@nickname"></xsl:value-of>
        </a>
      </div>
      <xsl:value-of select="@comment" disable-output-escaping="yes"/>
    </div>
  </li>
</xsl:template>
