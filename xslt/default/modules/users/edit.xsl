<xsl:template match="users_module[@action='edit']">
	<xsl:variable name="profile" select="profile" />
	<script src="{&prefix;}static/default/js/profileModule.js"></script>
  <div class="users-edit module">
    <form method="post" enctype="multipart/form-data" action="{&prefix;}user/{$profile/@id}">
      <input type="hidden" name="writemodule" value="ProfileWriteModule" />
      <input type="hidden" name="id" value="{$profile/@id}" />
      <div class="form-group">
        <h2>Информация</h2>
        <div class="form-field">
          <label>Ник</label>
          <b><xsl:value-of select="$profile/@nickname"></xsl:value-of></b>
        </div>
        <div class="form-field">
          <label>Почта</label>
          <b><xsl:value-of select="$profile/@email"></xsl:value-of></b>
        </div>
        <div class="form-field">
          <label>Дата рождения</label>
          <input name="bday" value="{$profile/@bday}" />
        </div>
        <div class="form-field">
          <label>Аватар</label>
          <input type="file" name="picture"></input>
        </div>
        <xsl:call-template name="profile_edit_cityLoader">
          <xsl:with-param name="current_city" select="$profile/@city_id" />
        </xsl:call-template>
        <div class="form-field">
          <label for="">Пару слов о себе</label>
          <textarea name="about">
            <xsl:value-of select="$profile/@about" disable-output-escaping="yes" />	
          </textarea>
        </div>
        <div class="form-field">
          <label for="">Мои любимые цитаты</label>
          <textarea name="quote">
            <xsl:value-of select="$profile/@quote" disable-output-escaping="yes" />	
          </textarea>
        </div>
      </div>
      <div class="form-group">
        <h2>Контакты</h2>
        <div class="form-field">
          <label for="">Facebook</label>
          <input name="link_fb" value="{$profile/@link_fb}"></input>
        </div>
        <div class="form-field">
          <label for="">Livejournal</label>
          <input name="link_lj" value="{$profile/@link_lj}"></input>
        </div>
        <div class="form-field">
          <label for="">Vkontakte</label>
          <input name="link_vk" value="{$profile/@link_vk}"></input>
        </div>
        <div class="form-field">
          <label for="">Twitter</label>
          <input name="link_tw" value="{$profile/@link_tw}"></input>
        </div>
      </div>
      <div class="form-control">
        <input type="submit" value="Сохранить информацию"/>
      </div>
    </form>
  </div>
	<script type="text/javascript">
    $(function() {
      $("input[name='bday']").datepicker($.datepicker.regional["ru"] = {dateFormat: 'yy-mm-dd'});
    });
	</script>
</xsl:template>

<xsl:template name="profile_edit_cityLoader">
  <xsl:param name="current_city"></xsl:param>
  <div class="form-field">
    <label>Страна:</label>
    <div id="counry_div">загружаем...</div>
  </div>
  <div class="form-field">
    <label>Город:</label>
    <div id="city_div">загружаем...</div>
  </div>
  <script>
    <xsl:text>profileModule_cityInit('counry_div','city_div','</xsl:text>
    <xsl:value-of select="$current_city"></xsl:value-of>
    <xsl:text>','</xsl:text>
    <xsl:value-of select="&prefix;"></xsl:value-of>
    <xsl:text>');</xsl:text>
  </script>
</xsl:template>
