<?php
/**
 */


/**
 *  PHPExcel_Writer_RTF
 *
 *  @category    PHPExcel
 *  @package     PHPExcel_Writer_PDF
 *  @copyright   Copyright (c) 2006 - 2013 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_Writer_RTF
{

    /**
     * The wrapper for the requested RTF rendering engine
     *
     * @var PHPExcel_Writer_PDF_Core
     */
    private $_renderer = NULL;

    /**
     *  Instantiate a new renderer of the configured type within this container class
     *
     *  @param  PHPExcel   $phpExcel         PHPExcel object
     *  @throws PHPExcel_Writer_Exception    when PDF library is not configured
     */
    public function __construct(PHPExcel $phpExcel)
    {
        $rtfLibraryName = PHPExcel_Settings::getRtfRendererName();
        if (is_null($rtfLibraryName)) {
            throw new PHPExcel_Writer_Exception("RTF Rendering library has not been defined.");
        }

        $rtfLibraryPath = PHPExcel_Settings::getRtfRendererPath();
        if (is_null($rtfLibraryName)) {
            throw new PHPExcel_Writer_Exception("RTF Rendering library path has not been defined.");
        }
        $includePath = str_replace('\\', '/', get_include_path());
        $rendererPath = str_replace('\\', '/', $rtfLibraryPath);
        if (strpos($rendererPath, $includePath) === false) {
            set_include_path(get_include_path() . PATH_SEPARATOR . $rtfLibraryPath);
        }

        $rendererName = 'PHPExcel_Writer_RTF_' . $rtfLibraryName;
        $this->_renderer = new $rendererName($phpExcel);
    }


    /**
     *  Magic method to handle direct calls to the configured PDF renderer wrapper class.
     *
     *  @param   string   $name        Renderer library method name
     *  @param   mixed[]  $arguments   Array of arguments to pass to the renderer method
     *  @return  mixed    Returned data from the PDF renderer wrapper method
     */
    public function __call($name, $arguments)
    {
        if ($this->_renderer === NULL) {
            throw new PHPExcel_Writer_Exception("RTF Rendering library has not been defined.");
        }

        return call_user_func_array(array($this->_renderer, $name), $arguments);
    }

}
