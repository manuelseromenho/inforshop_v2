<?xml version="1.0" encoding="utf-8"?> 
<xsl:stylesheet version="1.0"  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/"> 
  <html>
    <head><title>Clientes</title></head> 
    <body> 

    <div align="center">
      <span style="font-size:20px; font-weight: bold; font-style: italic">Clientes</span>
      <table border="1"> 
        <tr bgcolor="#9acd32">
          <th>ID Cliente</th>
          <th>Nome Cliente</th>
          <th>Morada</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th>NIF</th>
        </tr>

          <xsl:for-each select="Clientes/Cliente">
            <xsl:sort select="id_Cliente"/>
            <tr>
              <td><xsl:value-of select="id_Cliente"/></td>
              <td><xsl:value-of select="nome"/></td>
              <td><xsl:value-of select="morada"/></td>
              <td><xsl:value-of select="telefone"/></td>
              <td><xsl:value-of select="email"/></td>
              <td><xsl:value-of select="nif"/></td>
            </tr>
          </xsl:for-each>

      </table>
    </div>

    </body> 
  </html> 
</xsl:template>

</xsl:stylesheet> 