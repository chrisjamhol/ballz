<?php
use Illuminate\Support\Facades\Input;

/**
 * Class ImageController
 */
class ImageController extends BaseController {

    const userUploadsBasePath = '\useruploads';

    private $allowedFileTypes = array(
        'png',
        'jpg',
        'jpeg',
        'tif',
        'gif',
        'bmp',
        'psd'
    );

    /**
     * @param $size
     * @param $filename
     * @return \Illuminate\Http\Response
     */
    public function getImage($size, $filename) {
        $size = (string)$size;
        $filename = (string)$filename;
        $response = Response::make(
            Image::resize($filename, $size),
            200
        );

        $response->header(
            'content-type',
            Image::getMimeType($filename)
        );

        return $response;
    }

    /**
     * @param int $userID
     * @param int $gameID
     * @param string $size
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function getGameImage($userID, $gameID, $size, $filename) {
        $userID = (int)$userID;
        $gameID = (int)$gameID;
        $size = (string)$size;
        $filename = (string)$filename;
        $filePath = $userID.'/games/'.$gameID.'/'.$filename;
        $imageResponse = $this->getImage($size, $filePath);
        return $imageResponse;
    }

    /**
     * @param int $userID
     * @param int $gameID
     * @param $temporaryFile
     * @return bool|\Symfony\Component\HttpFoundation\File\File
     */
    public function saveUserUploadImageGame($userID, $gameID, $temporaryFile) {
        $userID = (int)$userID;
        $gameID = (int)$gameID;
        $imageName = '';

        $fileExtension = $temporaryFile->getClientOriginalExtension();
        $isFileExtensionAllowed = $this->checkIfExtensionIsAllowed($fileExtension);
        if($isFileExtensionAllowed):
            $folderNames = $this->buildGameFolderNames($userID, $gameID);
            $filename = $temporaryFile->getClientOriginalName();
            $this->createDirectoriesIfTheyNotExists(array($folderNames->userFolder.$folderNames->gameFolder));
            $file = $temporaryFile->move($folderNames->userFolder.$folderNames->gameFolder, $filename);
            if($file):
                $imageName = $filename;
            endif;
        endif;

        return $imageName;
    }

    /**
     * @param $folderNames
     */
    private function createDirectoriesIfTheyNotExists($folderNames) {
        $folderNames = (object)$folderNames;
        foreach($folderNames as $folderName):
            $isDirectory = is_dir($folderName);
            if(!$isDirectory):
                mkdir($folderName, 0777, true);
            endif;
        endforeach;
    }

    /**
     * @param $userID
     * @param $gameID
     * @return object
     */
    protected function buildGameFolderNames($userID, $gameID) {
        $userID = (int)$userID;
        $gameID = (int)$gameID;
        $userFolderName = $this->buildCleanPath(storage_path().self::userUploadsBasePath . '\\' . $userID);
        $gameFolderName = $this->buildCleanPath('\\games\\' . $gameID);
        return (object)array(
            'userFolder' => $userFolderName,
            'gameFolder' => $gameFolderName
        );
    }

    /**
     * @param $fileExtension
     * @return bool
     */
    private function checkIfExtensionIsAllowed($fileExtension) {
        $fileExtension = (string)$fileExtension;
        $allowed = in_array($fileExtension, $this->allowedFileTypes);
        return $allowed;
    }

    /**
     * @param $dirtyPath
     * @return mixed
     */
    private function buildCleanPath($dirtyPath) {
        $dirtyPath = (string)$dirtyPath;
        $cleanPath = str_replace('\\', '/', $dirtyPath);
        $cleanPath = preg_replace('/\/+/', '/', $cleanPath);
        return $cleanPath;
    }
}
