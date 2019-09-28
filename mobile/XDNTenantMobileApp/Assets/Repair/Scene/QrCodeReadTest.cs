using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class QrCodeReadTest : MonoBehaviour
{

    public Text qrTextContent;
    [SerializeField] QrCodeWebCamRead qrCodeRead;

    // Start is called before the first frame update
    void Start()
    {
        qrCodeRead.eventQrCodeRead += (result) => {
            Debug.LogWarning("result: "+result);
           // qrTextContent.text = result.ToString();
        };
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
