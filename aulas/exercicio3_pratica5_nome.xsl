<?xml version="1.0" encoding="utf-8"?> 
<xsl:stylesheet version="1.0"  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/"> 
  <html>
    <head><title> Cd Colection </title></head> 
    <body> 

    <div align="center">
      <span style="font-size:20px; font-weight: bold; font-style: italic">My CD Collection</span>
      <table border="1"> 
        <tr bgcolor="#9acd32">
          <th>Title</th>
          <th>Artist</th>
        </tr>

          <xsl:for-each select="catalog/cd">
            <xsl:sort select="artist" />
            <tr>
              <td><xsl:value-of select="title"/></td>
              <td><xsl:value-of select="artist"/></td>
            </tr>
          </xsl:for-each>

      </table>
    </div>

    </body> 
  </html> 
</xsl:template>

</xsl:stylesheet> 