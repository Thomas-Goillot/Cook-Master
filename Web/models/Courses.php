<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Courses extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "courses";

        $this->getConnection();
    }


    /**
     * Get all courses request of a user
     * @return array
     */
    public function getAllCoursesRequestOfUser(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id_users ORDER BY date_of_courses DESC";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all courses request
     * @return array
     */
    public function getAllCoursesRequest(): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE statut = ". COURSES_PAYED ." ORDER BY date_of_courses DESC";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a course info by id
     * @param int $id
     *
     */
    public function getCourseById(int $id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_courses = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all recipes of a course
     * @return array
     */
    public function getAllRecipesOfCourse(int $id): array
    {
        $query = "SELECT * FROM choose_recipes WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_courses", $id);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $recipes = array();

        foreach ($res as $recipe) {
            $query = "SELECT * FROM recipes WHERE id_recipes = :id_recipes";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id_recipes", $recipe['id_recipes']);

            $stmt->execute();

            $recipes[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $recipes;
    }


    /**
     * add a course request
     * @return int
     */
    public function addCoursesRequest(int $course_type, string $special_request, \DateTime $course_date, int $userId): int
    {
        $sql = "INSERT INTO " . $this->table . " (type, special_request, date_of_courses, id_users, statut) VALUES (:course_type, :special_request, :date_of_courses, :id_users, ". COURSES_REQUEST.")";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(':course_type', $course_type);
        $stmt->bindParam(':special_request', $special_request);
        $date = $course_date->format('Y-m-d H:i:s');
        $stmt->bindParam(':date_of_courses', $date);
        $stmt->bindParam(':id_users', $userId);

        $stmt->execute();

        return $this->_connexion->lastInsertId();
    }

    /**
     * add Courses Request Recipes
     * @param int $id_courses
     * @param int $id_recipes
     * @return bool
     */
    public function addCoursesRequestRecipes(int $id_recipes, int $id_courses): bool
    {
        $sql = "INSERT INTO choose_recipes(id_recipes,id_courses) VALUES (:id_recipes,:id_courses)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(':id_courses', $id_courses);
        $stmt->bindParam(':id_recipes', $id_recipes);

        $stmt->execute();

        return true;
    }


    /**
     * addCoursesRequestAddress
     * @param string $address
     * @param string $city
     * @param string $postal_code
     * @param string $country
     * @param int $idCourse
     * @return bool
     */
    public function addCoursesRequestAddress(string $address, string $city, string $postal_code, string $country, int $idCourse) :bool
    {
        $sql = "UPDATE courses SET address = :address, city = :city, zip_code = :postal_code, country = :country WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($sql);

        $data = array(
            ":address" => $address,
            ":city" => $city,
            ":postal_code" => $postal_code,
            ":country" => $country,
            ":id_courses" => $idCourse
        );

        $stmt->execute($data);

        return true;
    }

    /**
     * addProviderToCourses
     * @param int $id_courses
     * @param int $id_provider
     * @return bool
     */
    public function addProviderToCourses(int $id_courses, int $id_provider): bool
    {
        $sql = "UPDATE courses SET id_providers = :id_provider, statut = :statut WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($sql);

        $data = array(
            ":id_provider" => $id_provider,
            ":statut" => COURSES_ACCEPTED,
            ":id_courses" => $id_courses
        );

        $stmt->execute($data);

        return true;
    }

    /**
     * Get all courses of a provider
     */
    public function getAllCoursesByProvider(int $id): array
    {
        $query = "SELECT * FROM courses WHERE id_providers = :id AND statut != ". COURSES_ARCHIVED ." ORDER BY date_of_courses DESC";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Remove provider from a course
     * @param int $id_courses
     * @return bool
     */
    public function removeProviderFromCourse(int $id_courses): bool
    {
        $sql = "UPDATE courses SET id_providers = :id_provider, statut = :statut WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($sql);

        $data = array(
            ":id_provider" => null,
            ":statut" => COURSES_PAYED,
            ":id_courses" => $id_courses
        );

        $stmt->execute($data);

        return true;
    }

    /**
     * addlinkToCourses
     * @param int $id_courses
     * @param string $link
     * @return bool
     */
    public function addlinkToCourses(int $id_courses, string $link): bool
    {
        $sql = "UPDATE courses SET link = :link WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($sql);

        $data = array(
            ":link" => $link,
            ":id_courses" => $id_courses
        );

        $stmt->execute($data);

        return true;
    }

    /**
     * Update the status of a course
     * @param int $id_courses
     * @param int $status
     * @return bool
     */
    public function updateCourseStatus(int $id_courses, int $status): bool
    {
        $sql = "UPDATE courses SET statut = :statut WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($sql);

        $data = array(
            ":statut" => $status,
            ":id_courses" => $id_courses
        );

        $stmt->execute($data);

        return true;
    }

    /**
     * Update the total_price of a course
     * @param int $id_courses
     * @param float $total_price
     * @return bool
     */
    public function updateCourseTotalPrice(int $id_courses, float $total_price): bool
    {
        $sql = "UPDATE courses SET total_price = :total_price WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($sql);

        $data = array(
            ":total_price" => $total_price,
            ":id_courses" => $id_courses
        );

        $stmt->execute($data);

        return true;
    }

    /**
     * Get user id of a course
     */
    public function getUserIdByCourseId(int $id): int
    {
        $query = "SELECT id_users FROM courses WHERE id_courses = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res['id_users'];
    }

    /**
     * Get user id of the provider of a course
     * @param int $id
     * @return int
     */
    public function getUserIdbyProviderId(int $id): int
    {
        $query = "SELECT id_users FROM providers WHERE id_providers = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res['id_users'];
    }


    /**
     * Add commentary to a course
     * @param int $id_courses
     * @param string $commentary
     * @return bool
     */
    public function addCommentaryToCourse(int $id_courses, string $commentary): bool
    {
        $sql = "UPDATE courses SET commentary = :commentary WHERE id_courses = :id_courses";

        $stmt = $this->_connexion->prepare($sql);

        $data = array(
            ":commentary" => $commentary,
            ":id_courses" => $id_courses
        );

        $stmt->execute($data);

        return true;
    }

    
}

?>