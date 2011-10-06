
<xsl:template match="content_module[@action='show' and @mode='random']">
    <xsl:apply-templates select="picture" mode="picture-item"></xsl:apply-templates>
</xsl:template>

<xsl:template match="content_module[@action='show' and not(@mode)]">
    <xsl:apply-templates select="picture" mode="picture-item"></xsl:apply-templates>
</xsl:template>

<xsl:template match="*" mode="picture-item">
    <div class="picture-item container">
        <div class="picture-item header">
            <div class="picture-item id">
                <a href="{@link_url}">
                    <xsl:text>#</xsl:text>
                    <xsl:value-of select="@id" />
                </a>
            </div>
            <div class="picture-item title" >
                <xsl:value-of select="@title" />
            </div>
            <div class="picture-item tags">
                <xsl:if test="tags/item">
                    <div class="tag-item">
                        <xsl:text>теги: </xsl:text>
                    </div>
                </xsl:if>
                <xsl:for-each select="tags/item">
                    <div class="tag-item">
                        <a href="#">
                            <xsl:value-of select="@title" />
                        </a>
                    </div>
                </xsl:for-each>
            </div>
        </div>
        <div class="picture-item left">
            <a href="#"></a>
        </div>
        <div class="picture-item right">
            <a href="#"></a>
        </div>
        <div class="picture-item poo">
            <a href="#"></a>
        </div>
        <div class="picture-item random">
            <a href="#"></a>
        </div>
        <div class="picture-item heart">
            <a href="#"></a>
        </div>
        <div class="picture-item item">
            <div class="picture-item image">
                <div class="picture-item imagepre">
                    <img src="{@source}" />
                </div>
            </div>
        </div>
    </div>
</xsl:template>

