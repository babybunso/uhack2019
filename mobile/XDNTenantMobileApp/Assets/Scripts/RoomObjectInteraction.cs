using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class RoomObjectInteraction : MonoBehaviour
{
    public InputField reportField;
    public GameObject reportPanel;

    private void OnMouseDown()
    {
        reportPanel.SetActive(true);
        Debug.Log("@@@ gaile pressed: " + this.gameObject.name);
        PlayerPrefs.SetString("ReportIncident", this.gameObject.name);
        reportField.text = PlayerPrefs.GetString("ReportIncident");
    }
}
