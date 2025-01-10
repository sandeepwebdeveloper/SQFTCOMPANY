<?php
/**
 * Content Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class NeighbourhoodMapCallout
 */
class NeighbourhoodMapCallout {
    /**
     * NeighbourhoodMapCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_NeighbourhoodMap_callout_mapping' ), 99 );
        add_shortcode( 'kc_NeighbourhoodMap_callout', array( $this, 'kc_NeighbourhoodMap_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_NeighbourhoodMap_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_NeighbourhoodMap_callout' => array(
                        'name'        => __( 'Neighbourhood Map Callout', 'msteele' ),
                        'description' => __( 'Display Neighbourhood Map content', 'msteele' ),
                        'icon'        => '',
                        'category'    => 'Content',
                        'params'      => array(
                            'General'       => array(
                                array(
                                    'name'        => 'main_content',
                                    'label'       => 'Content',
                                    'type'        => 'editor',
                                    'description' => 'Content',
                                )
                            ),
                            'Customization' => array(
                                array(
                                    'name'        => 'class',
                                    'label'       => 'Extra Class Name',
                                    'type'        => 'text',
                                    'description' => 'Enter extra class name for the element',
                                )
                            ),
                            'Animation'     => array(
                                array(
                                    'name'        => 'data-aos',
                                    'label'       => 'AOS Type',
                                    'type'        => 'text',
                                    'description' => 'Enter AOS animation type, leave empty for no animation',
                                ),
                                array(
                                    'name'        => 'data-aos-offset',
                                    'label'       => 'AOS Offset',
                                    'type'        => 'text',
                                    'description' => 'Change offset to trigger animations sooner or later',
                                    'value'       => '120',
                                ),
                                array(
                                    'name'        => 'data-aos-duration',
                                    'label'       => 'AOS Duration',
                                    'type'        => 'text',
                                    'description' => 'Duration of animation (default 400)',
                                    'value'       => '400',
                                ),
                                array(
                                    'name'        => 'data-aos-easing',
                                    'label'       => 'AOS Easing',
                                    'type'        => 'text',
                                    'description' => 'Choose timing function to ease elements in different ways',
                                    'value'       => 'ease',
                                ),
                                array(
                                    'name'        => 'data-aos-delay',
                                    'label'       => 'AOS Delay',
                                    'type'        => 'text',
                                    'description' => 'Delay animation in ms',
                                    'value'       => '0',
                                ),
                                array(
                                    'name'        => 'data-aos-anchor',
                                    'label'       => 'AOS Anchor',
                                    'type'        => 'text',
                                    'description' => 'Anchor element, whose offset will be counted to trigger animation',
                                    'value'       => '',
                                ),
                                array(
                                    'name'        => 'data-aos-anchor-placement',
                                    'label'       => 'AOS Anchor Placement',
                                    'type'        => 'text',
                                    'description' => 'Which one position of element on the screen should trigger animation',
                                    'value'       => 'top-bottom',
                                ),
                            ),
                        ),
                    ),  // End of element
                )
            ); // End add map
        } // End if
    }

    /**
     * Output element
     *
     * @param $atts
     *
     * @return string
     * @since 1.0.0
     */
    function kc_NeighbourhoodMap_callout_html( $atts ) {
        // params extraction
        extract(
            shortcode_atts(
                array(
                    'main_content'              => '',
                    'class'                     => '',
                    'data-aos'                  => '',
                    'data-aos-offset'           => '',
                    'data-aos-duration'         => '',
                    'data-aos-easing'           => '',
                    'data-aos-delay'            => '',
                    'data-aos-anchor'           => '',
                    'data-aos-anchor-placement' => '',
                ),
                $atts
            )
        );

        // get animation details
        $aos                  = 'data-aos="' . $atts['data-aos'] . '" ';
        $aos_offset           = 'data-aos-offset="' . $atts['data-aos-offset'] . '" ';
        $aos_duration         = 'data-aos-duration="' . $atts['data-aos-duration'] . '" ';
        $aos_easing           = 'data-aos-easing="' . $atts['data-aos-easing'] . '" ';
        $aos_delay            = 'data-aos-delay="' . $atts['data-aos-delay'] . '" ';
        $aos_anchor           = 'data-aos-anchor="' . $atts['data-aos-anchor'] . '" ';
        $aos_anchor_placement = 'data-aos-anchor-placement="' . $atts['data-aos-anchor-placement'] . '" ';

        // prepare the animation
        if ( ! empty ( $atts['data-aos'] ) ):
            $animation = $aos . $aos_offset . $aos_duration . $aos_easing . $aos_delay . $aos_anchor . $aos_anchor_placement;
        else:
            $animation = '';
        endif;

        // start the output
        ob_start(); ?>
        <div class="content-callout <?php echo $atts['class']; ?>">
            <div class="content-inner" <?php echo $animation; ?>>
                <div class="map-area row row-bg position-relative justify-content-start">
                    <div class="col-lg-4">
                        <div class="accordion" id="accordionExample">
                        <div class="card">
                                <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button id="#id-7" class="btn btn-link schools cards__title" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        ALL
                                    </button>
                                </h2>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="m-0">
                                        <button id="#id-1" class="btn btn-link food-dinning cards__title" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            FOOD & DINING
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul>
                                            <li><span>1 </span> ARDO Restaurant</li>
                                            <li><span>2 </span>Leña Restaurante</li>
                                            <li><span>3 </span>Saks Food Hall by Pusateri's</li>
                                            <li><span>4 </span>CC Lounge and Whisky Bar</li>
                                            <li><span>5 </span>Balzac's Market Street</li>
                                            <li><span>6 </span>The George Street Diner</li>
                                            <li><span>7 </span>Fusaro's East</li>
                                            <li><span>8 </span>Fahrenheit Coffee</li>
                                            <li><span>9 </span>George Restaurant</li>
                                            <li><span>10</span> Cafe Oro di Napoli</li>
                                            <li><span>11</span> Neo Coffee Bar</li>
                                            <li><span>12</span> Petit Dejeuner</li>
                                            <li><span>13</span> Bier Markt</li>
                                            <li><span>14</span> Gyu-Kaku Japanese BBQ</li>
                                            <li><span>15</span> Richmond Station</li>
                                            <li><span>16</span> Hy's Steakhouse & Cocktail Bar</li>
                                            <li><span>17</span> Sud Forno</li>
                                            <li><span>18</span> Sansotei Ramen</li>
                                            <li><span>19</span> Terroni</li>
                                            <li><span>20</span> Egg Club</li>
                                            <li><span>21</span> Cluck Clucks Chicken & Waffles</li>
                                            <li><span>22</span> St. Louis Bar & Grill</li>
                                            <li><span>23</span> Starbucks</li>
                                            <li><span>24</span> Carisma</li>
                                            <li><span>25</span> Chotto Matte Toronto</li>
                                            <li><span>26</span> Hendriks Restaurant & Bar</li>
                                            <li><span>27</span> LOUIX LOUIS</li>
                                            <li><span>28</span> Motorino (Citta)</li>
                                            <li><span>29</span> Pravda Vodka Bar</li>
                                            <li><span>30</span> The Carbon Bar</li>
                                            <li><span>31</span> Woods Restaurant & Bar</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button id="#id-2" class="btn btn-link collapsed entertainment cards__title" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Recreation & Fitness
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <ul>
                                                <li><span>32</span> Berczy Park</li>
                                                <li><span>33</span> St. James Park</li>
                                                <li><span>34</span> David Crombie Park</li>
                                                <li><span>35</span> Sugar Beach</li>
                                                <li><span>36</span> Sweat and Tonic</li>
                                                <li><span>37</span> Body + Soul Fitness</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button id="#id-3" class="btn btn-link collapsed shopping cards__title" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Shopping
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul>
                                            <li><span>38</span> CF Toronto Eaton Centre</li>
                                            <li><span>39</span> Winners</li>
                                            <li><span>40</span> Rocco's No Frills</li>
                                            <li><span>41</span> LCBO</li>
                                            <li><span>42</span> The Market by Longo's</li>
                                            <li><span>43</span> St. Lawrence Market</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button id="#id-4" class="btn btn-link collapsed lifestyle cards__title" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Education
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul>
                                            <li><span>44</span> Ryerson University</li>
                                            <li><span>45</span> George Brown College - St. James Campus - A Building</li>
                                            <li><span>46</span> George Brown College - St. James Campus - E Building</li>
                                            <li><span>47</span> George Brown College - St. James Campus - C Building</li>
                                            <li><span>48</span> George Brown College - St. James Campus - I Building</li>
                                            <li><span>49</span> George Brown College - Waterfront Campus</li>
                                            <li><span>50</span> OCAD U CO</li>
                                            <li><span>51</span> OCAD University</li>
                                            <li><span>52</span> University of Toronto</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                <h2 class="mb-0">
                                    <button id="#id-5" class="btn btn-link collapsed schools cards__title" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Transportation
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul>
                                            <li><span>53</span> Queen Station</li>
                                            <li><span>54</span> King Station</li>
                                            <li><span>55</span> Union Station</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSeven">
                                <h2 class="mb-0">
                                    <button id="#id-6" class="btn btn-link collapsed schools cards__title" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseFive">
                                        Entertainment & Leisure
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseSeven" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul>
                                            <li><span>56</span> The Distillery Historic District</li>
                                            <li><span>57</span> Yonge-Dundas Square</li>
                                            <li><span>58</span> CAA Ed Mirvish Theatre</li>
                                            <li><span>59</span> Cineplex Cinemas</li>
                                            <li><span>60</span> Yonge-Dundas and VIP</li>
                                            <li><span>61</span> Gooderham Building</li>
                                            <li><span>62</span> Scotiabank Arena</li>
                                            <li><span>63</span> Massey Hall</li>
                                            <li><span>64</span> Nathan Phillips Square</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 pl-0 map-height">
                        <div id="id-1" class="map-image pageAttr">
                            <img src="/wp-content/uploads/2022/03/Neighbourhood_Map_1-31_2x.jpg" alt="">
                        </div>
                        <div id="id-2" class="map-image pageAttr">
                            <img src="/wp-content/uploads/2022/03/Neighbourhood_Map_32-37_2x.jpg" alt="">    
                        </div>
                        <div id="id-3" class="map-image pageAttr">
                            <img src="/wp-content/uploads/2022/03/Neighbourhood_Map_38-43_2x.jpg" alt="">   
                        </div>
                        <div id="id-4" class="map-image pageAttr">
                            <img src="/wp-content/uploads/2022/03/Neighbourhood_Map_44-52_2x.jpg" alt="">
                            
                        </div>
                        <div id="id-5" class="map-image pageAttr">
                            <img src="/wp-content/uploads/2022/03/Neighbourhood_Map_53-55_2x.jpg" alt="">   
                        </div>
                        <div id="id-6" class="map-image pageAttr">
                            <img src="/wp-content/uploads/2022/03/Neighbourhood_Map_56-63_2x.jpg" alt=""> 
                        </div>
                        <div id="id-7" class="map-image pageAttr">
                            <img src="/wp-content/uploads/2022/03/Neighbourhood_Map_1-63_2x.jpg" alt=""> 
                        </div>
                        
                    </div>
                </div>
            </div>
            </div>
    
        <?php

        return ob_get_clean();

    }
}

new NeighbourhoodMapCallout();