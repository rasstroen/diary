<xsl:template match="series_module[@action='edit']">
  <script language="javascript" type="text/javascript" src="{&prefix;}static/default/js/tiny_mce/tiny_mce.js"></script>
  <div class="series-edit module">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="writemodule" value="SeriesWriteModule" />
      <input type="hidden" name="id" value="{serie/@id}" />
      <div class="form-group">
        <h2 class="series-show-title">Редактирование серии «<xsl:value-of select="serie/@title"/>»</h2>
        <div class="form-field">
          <label>Название серии</label>
          <input name="title" value="{serie/@title}" />
        </div>
        <div class="form-field">
          <label>Описание серии</label>
          <textarea name="description">
            <xsl:value-of select="serie/@description" />	
          </textarea>
        </div>
      </div>
      <div class="form-control">
        <input type="submit" value="Сохранить информацию"/>
      </div>
    </form>
    <script type="text/javascript">
      tinyMCE.init({mode:"textareas"});
    </script>
  </div>
</xsl:template>
