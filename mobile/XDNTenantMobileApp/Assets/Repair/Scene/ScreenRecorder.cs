using UnityEngine;
using System.Collections;
using System.IO;
using UnityEngine.UI;

// Screen Recorder will save individual images of active scene in any resolution and of a specific image format
// including raw, jpg, png, and ppm.  Raw and PPM are the fastest image formats for saving.
//
// You can compile these images into a video using ffmpeg:
// ffmpeg -i screen_3840x2160_%d.ppm -y test.avi

public class ScreenRecorder : MonoBehaviour
{
    public RawImage rawimage;
    public GameObject showImage;
    WebCamTexture webcamTexture;

    public void CaptureScreenShot()
    {
        webcamTexture = new WebCamTexture();
        rawimage.texture = webcamTexture;
        rawimage.material.mainTexture = webcamTexture;
        webcamTexture.Play();
        showImage.SetActive(true);
    }

    public void CaptureScreen()
    {
        webcamTexture.Stop();
    }
}
