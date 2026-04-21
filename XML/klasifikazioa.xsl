<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:param name="denboraldia" />

    <xsl:template match="/">
        <xsl:apply-templates
            select="boleibol_federazioa/denboraldiak/denboraldia[denboraldiIzena = $denboraldia]" />
    </xsl:template>

    <xsl:template match="denboraldia">
        <section class="tabla-contenedor">

            <h2 class="denboraldi_titulo">
                <xsl:value-of select="denboraldiIzena" />
            </h2>
            <table class="tabla-klasi">
                <thead>
                    <tr>
                        <th class="pos-col">#</th>
                        <th class="team-col">Taldea</th>
                        <th>Partidak</th>
                        <th>Irabaziak</th>
                        <th>Galdutakoak</th>
                        <th class="points-col">Puntuak</th>
                    </tr>
                </thead>

                <tbody>
                    <xsl:for-each select="sailkapena/taldeSailkapena">

                        <tr>
                            <xsl:attribute name="class">

                                <!-- Baldintzen arabera klase bat aukeratzen da -->
                                <xsl:choose>

                                    <!-- Taldea 1. postuan badago -->
                                    <xsl:when test="postua = 1">champions</xsl:when>

                                    <!-- Taldea 2. postuan badago -->
                                    <xsl:when test="postua = 2">europa</xsl:when>

                                    <!-- Taldea 4. postutik beherago badago -->
                                    <xsl:when test="postua &gt;= 4">relegation</xsl:when>

                                </xsl:choose>

                            </xsl:attribute>

                            <!-- Taldearen posizioa (postua) erakusten du -->
                            <td class="position">
                                <xsl:value-of select="postua" />
                            </td>

                            <!-- Taldearen informazioa (irudia + izena) -->
                            <td class="team">
                                <div class="team-info">

                                    <!-- Irudia klik egitean, taldeak.php sartuko da -->
                                    <a href="taldeak.php?talde={taldeIzena}">
                                        <img src="irudiak/{taldeIzena}.png"
                                            alt="{taldeIzena}" width="32" height="32" />
                                    </a>

                                    <!-- Taldearen izena erakusten du -->
                                    <span>
                                        <xsl:value-of select="taldeIzena" />
                                    </span>

                                </div>
                            </td>

                            <!-- Jokatutako partiduen kopurua -->
                            <td>
                                <xsl:value-of select="jokatutakoPartidak" />
                            </td>

                            <!-- Irabazitako partiduen kopurua -->
                            <td>
                                <xsl:value-of select="irabazitakoak" />
                            </td>

                            <!-- Galdutako partiduen kopurua -->
                            <td>
                                <xsl:value-of select="galduak" />
                            </td>

                            <!-- Taldearen puntuak -->
                            <td class="points">
                                <xsl:value-of select="puntuak" />
                            </td>

                        </tr>

                    </xsl:for-each>

                </tbody>
            </table>

        </section>


    </xsl:template>
</xsl:stylesheet>