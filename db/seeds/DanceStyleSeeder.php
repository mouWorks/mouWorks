<?php


use Phinx\Seed\AbstractSeed;

class DanceStyleSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'style' => 'lindy',
                'desc_chinese' => '林迪舞'
            ],
            [
                'style' => 'blues',
                'desc_chinese' => '布魯伍斯舞'
            ],
            [
                'style' => 'balboa',
                'desc_chinese' => 'Balboa'
            ],
            [
                'style' => 'charleston',
                'desc_chinese' => '查爾斯頓'
            ],
            [
                'style' => 'zouk',
                'desc_chinese' => 'Zouk'
            ],
            [
                'style' => 'west coast swing',
                'desc_chinese' => 'WCS西岸搖擺舞'
            ]
        ];

        $posts = $this->table('danceStyles2');
        $posts->insert($data)
            ->save();
    }
}
