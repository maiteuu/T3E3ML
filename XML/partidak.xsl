<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />
    <xsl:template match="/">

        <!-- Orriaren titulua -->
        <h1 class="taldeak-titulua"> Federazioaren <span>Partiduak</span></h1>

        <!-- Denboraldi guztietan zehaztu -->
        <xsl:for-each select="boleibol_federazioa/denboraldiak/denboraldia">

            <section class="denboraldia">

                <h2>
                    <!-- Denboraldiaren izena -->
                    <xsl:value-of select="denboraldiIzena" />
                </h2>

                <!-- Jardunaldi guztietan  zehaztu -->
                <xsl:for-each select="jardunaldiak/jardunaldia">

                    <div class="jardunaldia">

                        <!-- Jardunaldi zenbakia -->
                        <h3> Jardunaldia <xsl:value-of select="jardunaldiZbk" />
                        </h3>

                        <div class="partida-taulak">

                            <!-- Jardunaldiko partida guztietan zehaztu -->
                            <xsl:for-each select="partidak/partida">

                                <div class="partida">

                                    <!-- Etxeko eta kanpoko taldeak -->
                                    <div class="talde">
                                        <img src="irudiak/{etxekoLogoa}" alt="{etxekoTaldea}" />
                                        <span class="etxekoa">
                                            <xsl:value-of select="etxekoTaldea" />
                                        </span>
                                    </div>

                                    <span class="vs">vs</span>

                                    <div class="talde">
                                        <img src="irudiak/{kanpokoLogoa}" alt="{kanpokoTaldea}" />
                                        <span class="kanpokoa">
                                            <xsl:value-of select="kanpokoTaldea" />
                                        </span>
                                    </div>

                                    <!-- Partidaren emaitza -->
                                    <div class="emaitza">

                                        <xsl:choose>
                                            
                                            <!-- Emaitza badago, erakutsi -->
                                            <xsl:when test="emaitza">
                                                <strong>
                                                    <xsl:value-of select="emaitza" />
                                                </strong>
                                            </xsl:when>

                                            <!-- Emaitzarik ez badago -->
                                            <xsl:otherwise>
                                                <em>Programatuta</em>
                                            </xsl:otherwise>
                                        </xsl:choose>

                                    </div>

                                </div>

                            </xsl:for-each>

                        </div>

                    </div>

                </xsl:for-each>

            </section>

        </xsl:for-each>

    </xsl:template>

</xsl:stylesheet>