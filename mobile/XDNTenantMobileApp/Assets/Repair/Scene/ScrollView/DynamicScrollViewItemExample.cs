
namespace DigiFrame {

    using UnityEngine;
    using UnityEngine.EventSystems;
    using UnityEngine.UI;
    //using Digify;
    using System.Collections;
    using System.Collections.Generic;

    public class DynamicScrollViewItemExample : UIBehaviour, IDynamicScrollViewItem 
    {
        //Color blue1 = new Color(255, 255, 255);
        private readonly Color[] colors = new Color[] {
            new Color(142, 225, 252),
            new Color(214, 246, 251)
	    };

	    public Text  title;
	    public Image background;
        public Button weatherDate;
        [HideInInspector]


        void LoadWeatherDetailsByDate(int weatherIndex)
        {
           

        }

        public void onUpdateItem( int index ) {
          
        }
    }
}