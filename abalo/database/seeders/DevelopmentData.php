<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentData extends Seeder
{
    /**
     * Seeders for three tables:
     *      ab_user, ab_articles, ab_articlecategory.
     +
     * Seeding three csv files in one run:
     *      user.csv, articles.csv, articlecategory.csv
     */
    public function run(): void
    {
       //$this->seedArticles();
       //$this->seedUsers();
       //$this->seedArticlecategory();
       //$this->seedArticleImages();
        $this->seedArticleHasCategory();
    }

    public function seedArticles(): void{
        $table = 'ab_article';
        $fileName = 'articles.csv';
        $filePath = database_path("data/$fileName");

        if (!file_exists($filePath)) {
            //  Variables in Strings?
            $this->command->error("CSV Datei '$fileName' wurde nicht gefunden");
            return;
        }

        $file = fopen($filePath, "r");
        $header = fgetcsv($file, 0, ';');

        while ($row = fgetcsv($file, 0, ';')) {
            $row[2] = intval(str_replace('.', '', $row[2]));

            //  File types?
            $data = array_combine($header, $row);

            //Remove '.' from integer number values


            DB::table($table)->insert($data);
        }

        fclose ($file);

        $this->command->info("Tabelle '$table' erfolgreich mit Daten aus
            '$fileName' befüllt");
    }

    public function seedUsers(): void{
        $table = 'ab_user';
        $fileName = 'user.csv';
        $filePath = database_path("data/$fileName");

        if (!file_exists($filePath)) {
            //  Variables in Strings?
            $this->command->error("CSV Datei '$fileName' wurde nicht gefunden");
            return;
        }

        $file = fopen($filePath, "r");
        $header = fgetcsv($file, 0, ';');

        while ($row = fgetcsv($file, 0, ';')) {
            $data = array_combine($header, $row);
            DB::table($table)->insert($data);
        }

        fclose ($file);

        $this->command->info("Tabelle '$table' erfolgreich mit Daten aus
            '$fileName' befüllt");
    }

    public function seedArticlecategory(): void{
        $table = 'ab_articlecategory';
        $fileName = 'articlecategory.csv';
        $filePath = database_path("data/$fileName");

        if (!file_exists($filePath)) {
            //  Variables in Strings?
            $this->command->error("CSV Datei '$fileName' wurde nicht gefunden");
            return;
        }

        $file = fopen($filePath, "r");
        $header = fgetcsv($file, 0, ';');

        while ($row = fgetcsv($file, 0, ';')) {
            foreach($row as $key => $value){
                if (strtoupper($value) === 'NULL')
                    $row[$key] = null;
            }

            $data = array_combine($header, $row);
            DB::table($table)->insert($data);
        }

        fclose ($file);

        $this->command->info("Tabelle '$table' erfolgreich mit Daten aus
                    '$fileName' befüllt");
    }
    public function seedArticleImages(): void{
        $table = 'ab_article_image';
        $fileName = 'article_img_files.csv';
        $filePath = database_path("data/$fileName");

        if (!file_exists($filePath)) {
            $this->command->error("CSV Datei '$fileName' wurde nicht gefunden");
            return;
        }

        $file = fopen($filePath, "r");
        $header = fgetcsv($file, 0, ';');

        while ($row = fgetcsv($file, 0, ';')) {
            //  NULL value conversion
            foreach($row as $key => $value){
                if (strtoupper($value) === 'NULL')
                    $row[$key] = null;
            }

            $data = array_combine($header, $row);
            DB::table($table)->insert($data);
        }

        fclose ($file);

        $this->command->info("Tabelle '$table' erfolgreich mit Daten aus
                    '$fileName' befüllt");
    }

    public function seedArticleHasCategory(): void{
        $table = 'ab_article_has_articlecategory';
        $fileName = 'article_has_articlecategory.csv';
        $filePath = database_path("data/$fileName");

        if (!file_exists($filePath)) {
            $this->command->error("CSV Datei '$fileName' wurde nicht gefunden");
            return;
        }

        $file = fopen($filePath, "r");
        $header = fgetcsv($file, 0, ';');

        while ($row = fgetcsv($file, 0, ';')) {
            foreach($row as $key => $value){
                if (strtoupper($value) === 'NULL')
                    $row[$key] = null;
            }

            $data = array_combine($header, $row);
            DB::table($table)->insert($data);
        }

        fclose ($file);

        $this->command->info("Tabelle '$table' erfolgreich mit Daten aus
                    '$fileName' befüllt");
    }

}
