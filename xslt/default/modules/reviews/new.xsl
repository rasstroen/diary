
<xsl:template match="reviews_module[@action='new']">
	<script language="javascript" type="text/javascript" src="{&prefix;}static/default/js/tiny_mce/tiny_mce.js"></script>
	<xsl:if test="(&current_profile;)/@id">
		<div class="reviews-new module">
			<h2>Оставьте отзыв</h2>
			<form method="post">
				<input type="hidden" value="ReviewsWriteModule" name="writemodule" />
				<input type="hidden" value="{review/@target_id}" name="target_id" />
				<input type="hidden" value="{review/@target_type}" name="target_type" />
				<div class="form-field">
					<label for="annotation">Текст отзыва</label>
					<textarea name="annotation">
						<xsl:value-of select="review/@html" disable-output-escaping="yes" />
					</textarea>
				</div>
				<div class="form-field">
					<label for="rate">Оценка</label>
					<select name="rate">
						<option value="0">-</option>
						<option value="1">
							<xsl:if test="review/@rate = 1">
								<xsl:attribute name="selected">selected</xsl:attribute>	    
							</xsl:if>
							<xsl:text>1</xsl:text>
						</option>
						<option value="2">
							<xsl:if test="review/@rate = 2">
								<xsl:attribute name="selected">selected</xsl:attribute>	    
							</xsl:if>
							<xsl:text>2</xsl:text>
						</option>
						<option value="3">
							<xsl:if test="review/@rate = 3">
								<xsl:attribute name="selected">selected</xsl:attribute>	    
							</xsl:if>
							<xsl:text>3</xsl:text>
						</option>
						<option value="4">
							<xsl:if test="review/@rate = 4">
								<xsl:attribute name="selected">selected</xsl:attribute>	    
							</xsl:if>
							<xsl:text>4</xsl:text>
						</option>
						<option value="5">
							<xsl:if test="review/@rate = 5">
								<xsl:attribute name="selected">selected</xsl:attribute>	    
							</xsl:if>
							<xsl:text>5</xsl:text>
						</option>
					</select>
				</div>
				<div class="form-control">
					<input type="submit" value="Оставить отзыв" />
				</div>
			</form>
			<script type="text/javascript">
				tinyMCE.init({mode:"textareas"});
				//todo ajax will check if it's already review by current user
			</script>
		</div>
	</xsl:if>
</xsl:template>
