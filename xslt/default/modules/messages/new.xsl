
<xsl:template match="messages_module[@action='new']">
	<xsl:if test="(&current_profile;)/@id">
		<div class="reviews-new module">
			<h2>Новое сообщение</h2>
			<form method="post">
				<input type="hidden" value="MessagesWriteModule" name="writemodule" />
				<input type="hidden" value="{message/@thread_id}" name="thread_id" />
				<input type="hidden" value="{&current_profile;/@id}" name="id_author" />
				<xsl:if test="message/@thread_id=0">
					<div class="form-field">
						<label for="subject">Тема сообщения</label>
						<input type="text" name="subject" />
					</div>
				</xsl:if>
				<div class="form-field">
					<label for="body">Текст сообщения</label>
					<textarea name="body"/>
				</div>
				<xsl:if test="message/@thread_id=0">
					<div class="form-field">
						<label for="to">Получатели</label>
						<input type="text" name="to[]" />
					</div>
				</xsl:if>
				<div class="form-control">
					<input type="submit" value="Оставить отзыв" />
				</div>
			</form>
		</div>
	</xsl:if>
</xsl:template>
