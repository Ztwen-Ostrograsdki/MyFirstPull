<?php 

require_once "../../vendor/autoload.php";
$viewPath = dirname(__DIR__);
use MyFramework\Routing\Router;
use MyFramework\dbConnected\Connected;
$router = new Router($viewPath);


$router
    ->getPath('/', '/public'.DIRECTORY_SEPARATOR.'home', 'Home')
    
    ->getPath('/myschool', '/views/publicMenu/index', 'Main')
    ->getPath('/myschool/menu/enseignants', '/views/publicMenu/teachers/index', 'MainTeachers')
    ->getPath('/myschool/menu/enseignants/[*:discipline]', '/views/publicMenu/teachers/byDiscipline', 'MainTeachersByDiscipline')

    ->getPath('/myschool/menu/classes', '/views/publicMenu/classes/index', 'MainClasses')
    ->getPath('/myschool/menu/classes/primaire', '/views/publicMenu/classes/primaryLevel', 'MainClassesPrimary')
    ->getPath('/myschool/menu/classes/secondaire', '/views/publicMenu/classes/secondaryLevel', 'MainClassesSecondary')

    ->getPath('/myschool/menu/disciplines', '/views/publicMenu/disciplines/index', 'MainDisciplines')

    ->getPath('/myschool/menu/exams', '/views/publicMenu/exams/index', 'MainExams')

    ->getPath('/administration', '/views/admin/index', 'Admin')
    ->getPath('/administration/nouvelleClasse-[*:level]', '/views/admin/classes/newClasse', 'NewClasse')
    ->getPath('/administration/nouvelleDiscipline-[*:level]', '/views/admin/disciplines/newDiscipline', 'NewDiscipline')

    ->getPath('/administration/inscription/eleve-[*:level]', '/views/admin/pupils/newPupil', 'NewPupil')
    ->getPath('/administration/inscription/enseignant-[*:level]', '/views/admin/teachers/newTeacher', 'NewTeacher')

    ->getPath('/administration/classes/index', '/views/ecole/classes/index', 'AdminClasses')
    ->getPath('/administration/classes/le-[*:level]', '/views/ecole/classes/show', 'AdminClassesByLevel')
    ->post_getPath('/administration/classes/editiion/[*:level]-[i:id]', '/views/admin/classes/editClasse', 'AdminClassesEdited')

    ->getPath('/administration/eleves', '/views/ecole/pupils/index', 'AdminPupils')
    ->post_getPath('/administration/eleves/edition/[*:level]-[*:forWho]-[i:id]', '/views/admin/pupils/editPupilInfos', 'AdminPupilInfos')
    ->getPath('/administration/eleves/primaire', '/views/ecole/pupils/primary/index', 'AdminPupilsPrimary')
    ->getPath('/administration/eleves/primaire/listing/[*:classe]', '/views/ecole/pupils/primary/show', 'AdminPupilsPrimaryList')
    ->getPath('/administration/eleves/secondaire', '/views/ecole/pupils/secondary/index', 'AdminPupilsSecondary')
    ->getPath('/administration/eleves/secondaire/listing/[*:classe]', '/views/ecole/pupils/secondary/show', 'AdminPupilsSecondaryList')


    ->getPath('/administration/eleves/profil-de-[i:id]', '/views/ecole/pupils/pupilProfil', 'PupilProfil')
    ->getPath('/administration/enseignants/index', '/views/ecole/teachers/index', 'AdminTeachers')
    ->getPath('/administration/enseignants/primaire', '/views/ecole/teachers/primary/index', 'AdminTeachersPrimary')
    ->getPath('/administration/enseignants/secondaire', '/views/ecole/teachers/secondary/index', 'AdminTeachersSecondary')

    ->getPath('/administration/matieres', '/views/ecole/disciplines/index', 'AdminDisciplines')
    ->getPath('/administration/matieres-[*:level]', '/views/ecole/disciplines/primary/index', 'AdminDisciplinesPrimary')
    ->getPath('/administration/matieres-[*:level]', '/views/ecole/disciplines/secondary/index', 'AdminDisciplinesSecondary')
    ->getPath('/administration/disciplines/[*:discipline]', '/views/ecole/disciplines/showOneDiscipline', '1Disciplines')

    ->run();
