<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::drop('comment_post');

        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')
                ->after('user')
                ->default(1)
                ->index('post_id_idx');
        });
    }

    public function down(): void
    {
        DB::statement(<<<SQL
            create table comment_post
            (
                id      int auto_increment,
                comment int not null,
                blog    int not null,
                primary key (id, comment, blog),
                constraint id_UNIQUE
                    unique (id),
                constraint comment_post_comment
                    foreign key (comment) references comments (id),
                constraint comment_post_post
                    foreign key (blog) references posts (id)
            )
                charset = utf8mb3;
            SQL
        );

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('post_id');
        });
    }
};
