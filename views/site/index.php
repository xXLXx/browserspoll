<?php
use yii\helpers\Url;
use app\models\Browser;
use yii\helpers\Html;
use bburim\flot\Chart;
use bburim\flot\Plugin;
use yii\web\View;
?>
<?php
/* @var $this yii\web\View */
$this->title = 'Browser Poll';

$this->registerJsFile('@web/js/home.js', ['depends' => 'yii\web\JqueryAsset']);
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">This is Browsers Poll, a tally of user's favourite browsers.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute(['vote']) ?>">Vote for yours</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <?php $chartData = []; ?>
                <?=
                    yii\grid\GridView::widget([
                        'id'            => 'browser-grid',
                        'dataProvider'  => $browserDataProvider,
                        'layout'        => '{items}',
                        'columns'       => [
                            'name',
                            [
                                'label' => 'Raw Count',
                                'value' => function ($model) use(&$chartData) {
                                    $chartData[] = [
                                        'label' => $model->name,
                                        'data'  => $votesCount = sizeof($model->votes)
                                    ];

                                    return $votesCount;
                                }
                            ],
                            [
                                'label' => 'Percentage',
                                'value' => function ($model) use ($totalVotesCount) {
                                    return Yii::$app->formatter->asDouble(sizeof($model->votes) / $totalVotesCount * 100, 2) . '%';
                                }
                            ]
                        ] 
                    ]);
                ?>
            </div>
            <div class="col-lg-6">
                <span id="pie-hover-text" class="pull-left"></span>
                <?= Chart::widget([
                    'data' => $chartData,
                    'options' => [
                        'series' => [
                            'pie'   => [
                                'show'      => true,
                            ]
                        ],
                        'grid'  => [
                            'hoverable' => true
                        ]
                    ],
                    'htmlOptions' => [
                        'style'                 => 'width:400px; height:250px;',
                        'class'                 => 'center-block',
                        'data-hoverable-pie'    => '#pie-hover-text',
                        'data-hoverable-grid'   => '#browser-grid'
                    ],
                    'plugins' => [
                        // Use helper class with constants to specify plugin type
                        Plugin::PIE
                    ]
                ]);
                ?>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $extraColumns = [];
                    if (!\Yii::$app->user->isGuest) {
                        $extraColumns[] = 'ip';
                        $extraColumns[] = [
                            'attribute' => 'history',
                            'content' => function ($model) {
                                return Html::a($model->history, $model->history, ['target' => '_blank']);
                            }
                        ];
                    }
                ?>
                <?=
                    yii\grid\GridView::widget([
                        'dataProvider'  => $votesDataProvider,
                        'layout'        => "{items}\n<div class=pull-left>{summary}</div><div class=pull-right>{pager}</div>",
                        'columns'       => array_merge([
                            'name',
                            'email',
                            [
                                'attribute' => 'browser',
                                'value' => function ($model) {
                                    return Browser::findOne($model->browser)->name;
                                }
                            ],
                            'reason',
                            [
                                'attribute' => 'updated_at',
                                'format' => ['datetime', 'M d, Y h:iA']
                            ]
                        ], $extraColumns) 
                    ]);
                ?>
            </div>
        </div>

    </div>
</div>
