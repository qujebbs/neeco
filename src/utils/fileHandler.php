<?php
class FileUploadException extends Exception {}

class FileHandler
{
    private string $uploadDir;

    public function __construct(string $uploadDir = 'uploads/')
    {
        $this->uploadDir = rtrim($uploadDir, '/') . '/';

        if (!is_dir($this->uploadDir) && !mkdir($this->uploadDir, 0777, true)) {
            throw new FileUploadException("Failed to create upload directory: {$this->uploadDir}");
        }
    }

    public function uploadFile(array $file, array $allowedTypes, int $maxSize = 5242880) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new FileUploadException("File upload error: " . $this->getUploadError($file['error']));
        }
    
        if ($file['size'] > $maxSize) {
            throw new FileUploadException("File size exceeds the maximum limit of " . round($maxSize / 1048576, 2) . " MB.");
        }
    
        // Use finfo for MIME type detection
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
    
        if (!in_array($mimeType, $allowedTypes)) {
            throw new FileUploadException("Invalid file type. Allowed types are: " . implode(', ', $allowedTypes));
        }
    
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid('file_') . '.' . $fileExtension;
        $destination = $this->uploadDir . $uniqueFileName;
    
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new FileUploadException("Failed to move uploaded file.");
        }
    
        return basename($destination);
    }
    

    private function getUploadError(int $errorCode): string
    {
        return match ($errorCode) {
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
            default => "Unknown upload error.",
        };
    }
}
?>

