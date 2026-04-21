<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <!-- Kanpotik pasatzen den parametroa, aukeratutako taldea -->
    <xsl:param name="talde" />

    <xsl:template match="/">

        <!-- XML-eko talde zehatz bat aukeratu parametroaren arabera -->
        <xsl:apply-templates select="boleibol_federazioa/taldeak/taldea[taldeIzena = $talde]" />

    </xsl:template>

    <!-- 'taldea' nodoa tratatzeko -->
    <xsl:template match="taldea">

        <section class="taldeinfo">

            <!-- Taldearen izena -->
            <h1 class="talde-izena">
                <xsl:value-of select="taldeIzena" />
            </h1>

            <!-- Taldearen logotipoa -->
            <img class="talde-logo" src="irudiak/{taldeLogoa}" alt="{taldeIzena}" />

            <div class="talde-datuak">

                <!-- Taldearen deskribapena -->
                <p class="datu">
                    <strong>Nor Gara: </strong>
                    <xsl:value-of select="taldeDeskribapena" />
                </p>

                <!-- Taldeko lehendakaria -->
                <p class="datu">
                    <strong>Gure Lehendakaria: </strong>
                    <xsl:value-of select="taldeLehendakaria" />
                </p>

                <!-- Sorrera urtea -->
                <p class="datu">
                    <strong>Sorrera: </strong>
                    <xsl:value-of select="taldeSorrera" />
                </p>

                <!-- Taldearen zelaia -->
                <p class="datu">
                    <strong>Zelaia: </strong>
                    <xsl:value-of select="taldeZelaia" />
                </p>

            </div>

            <!-- Zelaiko irudia -->
            <img class="zelaiak" src="irudiak/{zelaiArgazkia}" alt="{taldeZelaia}" />

            <div class="jokalaroTaula">
                <h2 class="jokalari-titulo">Jokalariak</h2>

                <!-- Jokalarien taula -->
                <table class="jokalari-taula">

                    <thead>
                        <tr>
                            <th>Zenbakia</th>
                            <th>Irudia</th>
                            <th>Izen Abizena</th>
                            <th>Adina</th>
                            <th>Generoa</th>
                            <th>Posizioa</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- Jokalari bakoitza iteratzen da -->
                        <xsl:for-each select="jokalariak/jokalaria">

                            <tr>
                                <!-- Jokalariaren zenbakia -->
                                <td>
                                    <xsl:value-of select="jokalariZbk" />
                                </td>

                                <!-- Jokalariaren irudia -->
                                <td>
                                    <img class="jokalariIrudi" src="jokalariak/{jokalariIrudia}"
                                        alt="{jokalariIzenAbizena}" />
                                </td>

                                <!-- Izen-abizenak -->
                                <td>
                                    <xsl:value-of select="jokalariIzenAbizena" />
                                </td>

                                <!-- Adina -->
                                <td>
                                    <xsl:value-of select="jokalariAdina" />
                                </td>

                                <!-- Generoa -->
                                <td>
                                    <xsl:value-of select="generoa" />
                                </td>

                                <!-- Posizioa -->
                                <td>
                                    <xsl:value-of select="jokalariPosizioa" />
                                </td>
                            </tr>

                        </xsl:for-each>

                    </tbody>

                    <tfoot>

                        <tr>

                            <!-- Jokalari kopurua -->
                            <th colspan="2">
                                Jokalari
                            </th>
                            <th>
                                <xsl:value-of select="count(jokalariak/jokalaria/jokalariZbk)" />
                            </th>

                            <!-- Batazbesteko adina -->
                            <th colspan="2">
                                Batazbesteko adina
                            </th>
                            <th>
                                <xsl:value-of
                                    select="format-number(sum(jokalariak/jokalaria/jokalariAdina) div count(jokalariak/jokalaria/jokalariZbk), '0.00')" />
                            </th>

                        </tr>

                    </tfoot>

                </table>
                
            </div>

        </section>

    </xsl:template>
</xsl:stylesheet>