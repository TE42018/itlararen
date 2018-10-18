<?php

function vcas_component_quiz()
{
    vc_map(
        array(
            'name' => __('Quiz'),
            'base' => 'vcas_quiz',
            'category' => __('itlararen.se'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'holder' => __('h2'),
                    'class' => '',
                    'heading' => __('Title'),
                    'param_name' => 'quiz_title',
                    'value' => '',
                    'description' => __(''),
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'p',
                    'class' => '',
                    'heading' => __('Description'),
                    'param_name' => 'quiz_desc',
                    'value' => '',
                    'description' => __(''),
                ),
                array(
                    'type' => 'textarea_raw_html',
                    'heading' => __('Data'),
                    'param_name' => 'quiz_data',
                    'value' => 'sdfghjklö',
                    'description' => __('Quiz-data in JavaScript object format'),
                )
            )
        )	
    );
}

add_action('vc_before_init', 'vcas_component_quiz');

function vcas_quiz_function($atts, $content)
{
    global $wpdb;
    $date = date("Y-m-d");
    $org = $atts;

    $atts = shortcode_atts(
        array(
            'quiz_title' => '',
            'quiz_desc' => '',
            'quiz_data' => ''
        ),
        $atts,
        'vcas_quiz'
    );

    $title = $atts['quiz_title'];
    $desc = $atts['quiz_desc'];


    $json_raw = $atts['quiz_data'];
    $json_decoded = urldecode(base64_decode($json_raw));

    $object = json_decode($json_decoded);
    //echo $object->questions[0]->label;

    //$html .= $json_decoded;
        ob_start();
        ?>

        <a href="#" onclick="print_this(false); return false;"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/print.png" alt="Skriv ut frågorna">Skriv ut frågorna</a>
        <a href="#" onclick="print_this(true); return false;"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/print.png" alt="Skriv ut frågorna med facit">Skriv ut (med facit)</a>
       
       <div class="quiz">
        <h1> <?php echo $title ?> </h1>
        <p> <?php echo $desc ?> </p>

        <div id="questions"></div>
        <div id="error"></div>
        <div id="result"></div>
        <script type="text/javascript">

        function showWrongAnswer(){
            document.id('error').set('html', 'Wrong answer, Please try again');
        }

        function showScore() {
            var score = quizMaker.getScore();

            var el = new Element('h3');
            el.set('html', 'Tack för ditt svar!');
            document.id('result').adopt(el);

            el = new Element('h4');
            el.set('html', 'Poäng: ' + score.numCorrectAnswers + ' av ' + score.numQuestions);
            document.id('result').adopt(el);

            if(score.incorrectAnswers.length > 0) {
                el = new Element('h4');
                el.set('html', 'Felaktiga svar :');
                document.id('result').adopt(el);

                for(var i=0;i<score.incorrectAnswers.length;i++) {
                    var incorrectAnswer = score.incorrectAnswers[i];
                    el = new Element('div');
                    el.set('html', '<b>' +  incorrectAnswer.questionNumber + ': ' + incorrectAnswer.label + '</b>');
                    document.id('result').adopt(el);

                    el = new Element('div');
                    el.set('html', 'Korrekt svar : ' + incorrectAnswer.correctAnswer);
                    document.id('result').adopt(el);
                    el = new Element('div');
                    el.set('html', 'Ditt svar : ' + incorrectAnswer.userAnswer);
                    document.id('result').adopt(el);

                }
            }
        }

        var questions = <?php echo $json_decoded ?>;

        function showAnswerAlert() {
            document.id('error').set('html', 'Du måste svara innan du kan fortsätta!');
        }
        function clearErrorBox() {
            document.id('error').set('html','');
        }
        var quizMaker = new DG.QuizMaker({
            questions : questions,
            el : 'questions',
            forceCorrectAnswer:false,
            listeners : {
                'finish' : showScore,
                'missinganswer' : showAnswerAlert,
                'sendanswer' : clearErrorBox,
                'wrongAnswer' : showWrongAnswer
            }
        });
        quizMaker.start();

        function print_this(facit) {
                    HTMLtitle = '<h1>Quiz IPv4 Enkel</h1>\n';
                    HTMLdescrition = '<p>11 Frågor hämtade från dokumentet "Enkla IPv4-övningar".</p>\n';
                    HTMLstring = '<!DOCTYPE HTML><html lang="sv"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>IT-läraren - Quiz</title><style>h1{text-align: center;}p{text-align: center;}div:nth-child(odd){background-color: #EEEEEE;}ul{list-style-type: circle;}div{padding: 10px;page-break-inside: avoid;}</style></head><body>';
                    HTMLstring+= HTMLtitle + HTMLdescrition;

                    var qNumbers = questions.length;
                    for (i=0; i<qNumbers; i++)
                    {
                        j = i +1;
                        HTMLstring+='<div><b>Fråga ' + j + '<br>\n';
                        HTMLstring+= questions[i].label + '</b><br>\n';
                        HTMLstring+= '<ul>\n';
                        for(k=0; k<questions[i].options.length;k++)
                        {
                            HTMLstring+= '<li>' + questions[i].options[k] + '</li>';
                        }
                        HTMLstring+= '</ul>\n';
                        if(facit)
                        {
                            if(questions[i].answer.length>1)
                            {
                                HTMLstring+='<b>Rätt Svar:</b> ';
                                for(l=0;l<questions[i].answer.length; l++)
                                {
                                    HTMLstring+=questions[i].options[questions[i].answer[l]] + '\,  ';
                                }
                            }
                            else
                            {
                                HTMLstring+='<b>Rätt Svar:</b> ' + questions[i].answer + '<br>\n';
                            }
                        }
                        HTMLstring+='</div>\n';
                    }
                    HTMLstring+='<script>function findQuestionImage(){let img = document.getElementsByTagName("img")[0];if(img != undefined){img.src = "<?php echo plugin_dir_url( __FILE__ )?>img/" + img.src.substring(img.src.lastIndexOf("/")+1);}}window.setInterval(findQuestionImage, 300);<\/script>';
                    HTMLstring+='<p>© IT-Läraren Skåne</p></body></html>';
                
                    newwindow=window.open();
                    newdocument=newwindow.document;
                    newdocument.write(HTMLstring);
                    newdocument.close();
                }
            
            function findQuestionImage(){
                
                let img = document.getElementsByClassName("quiz")[0].getElementsByTagName("img")[0];
                    if(img != undefined){
                        img.src = "<?php echo plugin_dir_url( __FILE__ )?>img/" + img.src.substring(img.src.lastIndexOf('/')+1);
                    }
                }
            window.setInterval(findQuestionImage, 300);
        </script>


</div>




        <?php
    $html .= ob_get_clean();

return $html;

}
add_shortcode('vcas_quiz', 'vcas_quiz_function');

function itlararen_elements_enqueue_quiz_maker_script() {   
    wp_enqueue_script( 'dg-mootools-core', plugin_dir_url( __FILE__ ) . 'js/mootools-core-1.6.0.js' );
    wp_enqueue_script( 'dg-quiz-maker', plugin_dir_url( __FILE__ ) . 'js/dg-quiz-maker.js' );   
}
add_action('wp_enqueue_scripts', 'itlararen_elements_enqueue_quiz_maker_script');

?>