<?php

use Illuminate\Database\Seeder;
use App\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_id = User::orderBy('id', 'desc')->first()->id;

        for($i = 0; $i < 50; $i++) {

            $id = random_int(1, $max_id);
            DB::table('comments')->insert([
                'user_id' => $id,
                'user_name' => User::find($id)->name,
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce aliquam eros pretium odio maximus, ac mattis est cursus. Cras tincidunt sollicitudin velit, ut finibus nulla ullamcorper vel. Aliquam at turpis nisl. Sed eleifend venenatis arcu sit amet bibendum. Integer imperdiet felis vel ipsum sagittis aliquet. Curabitur ipsum augue, porttitor at.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

        }
        
    }
}
