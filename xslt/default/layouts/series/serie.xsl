<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet SYSTEM "entities.dtd">
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>

	<xsl:output omit-xml-declaration="yes"/>

	<xsl:output indent="yes"/>

	<xsl:include href="layout.xsl" />
	<xsl:include href="helpers.xsl" />

	<xsl:template match="&root;" mode="l-content">
		<xsl:apply-templates select="series_module[@action ='show']" />
	</xsl:template>

</xsl:stylesheet>
