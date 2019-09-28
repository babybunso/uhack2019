using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class UIClicks : MonoBehaviour
{

    public InputField username, password;
    public GameObject Login, StartScan;
    

    public void LoginUser()
    {
        Debug.Log("### Username:" + username.text);
        Debug.Log("### Password:" + password.text);
        StartScan.SetActive(true);
        Login.SetActive(false);
    }
    public void LoadReadQR()
    {
        SceneManager.LoadScene("QrCodeRead");
    }
}
